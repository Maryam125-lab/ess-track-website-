<?php

namespace App\Models;

class ServiceOrder
{
    private $conn;
    private $table = 'service_orders';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create(array $data)
    {
        $record = $this->normalize($data);

        if ($this->conn) {
            $query = "INSERT INTO {$this->table}
                (customer_name, email, phone, vehicle_no, vehicle_type, interested_package,
                 package_rate, package_price, residential_address, commercial_address, postal_code,
                 home_phone, office_phone, message, raw_payload, status)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'new')";

            $stmt = $this->conn->prepare($query);
            if ($stmt) {
                $raw = json_encode($data, JSON_UNESCAPED_UNICODE);
                $stmt->bind_param(
                    'sssssssssssssss',
                    $record['customer_name'],
                    $record['email'],
                    $record['phone'],
                    $record['vehicle_no'],
                    $record['vehicle_type'],
                    $record['interested_package'],
                    $record['package_rate'],
                    $record['package_price'],
                    $record['residential_address'],
                    $record['commercial_address'],
                    $record['postal_code'],
                    $record['home_phone'],
                    $record['office_phone'],
                    $record['message'],
                    $raw
                );

                if ($stmt->execute()) {
                    return $this->conn->insert_id;
                }
            }
        }

        $record['raw_payload'] = $data;
        $record['status'] = 'new';
        $record['order_type'] = 'service_agreement';
        $record['created_at'] = date('Y-m-d H:i:s');

        return $this->saveToStorage($record) ? time() : false;
    }

    private function normalize(array $data): array
    {
        return [
            'customer_name' => trim($data['name'] ?? ''),
            'email' => trim($data['email'] ?? ''),
            'phone' => trim($data['mobile'] ?? $data['phone'] ?? ''),
            'vehicle_no' => trim($data['vehicle_no'] ?? ''),
            'vehicle_type' => trim($data['v_type'] ?? $data['vehicle_type'] ?? ''),
            'interested_package' => trim($data['pkg_description'] ?? $data['interested_package'] ?? 'Not Sure'),
            'package_rate' => trim($data['pkg_rate'] ?? ''),
            'package_price' => trim($data['pkg_price'] ?? ''),
            'residential_address' => trim($data['res_address'] ?? ''),
            'commercial_address' => trim($data['comm_address'] ?? ''),
            'postal_code' => trim($data['postal_code'] ?? ''),
            'home_phone' => trim($data['num_home'] ?? ''),
            'office_phone' => trim($data['num_office'] ?? ''),
            'message' => trim($data['message'] ?? 'Service agreement submitted via website'),
        ];
    }

    private function storagePath()
    {
        return __DIR__ . '/../../storage/service_orders.json';
    }

    private function saveToStorage(array $record)
    {
        $path = $this->storagePath();
        $dir = dirname($path);
        if (! is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $items = [];
        if (file_exists($path)) {
            $items = json_decode(file_get_contents($path), true) ?: [];
        }

        $record['id'] = count($items) + 1;
        $items[] = $record;

        return file_put_contents($path, json_encode($items, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)) !== false;
    }
}
