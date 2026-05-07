<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>@yield('title', 'ESS-TRACK BY ESSPL — GPS Vehicle Tracking Pakistan')</title>
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="ESS-Track provides state-of-the-art 3G-2G vehicle tracking solutions in Pakistan with 24/7 call center support and real-time monitoring.">
    
    <!-- Fonts & Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- AOS Animations -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        :root{
            --nv:#0d1b2a;--nv2:#1b2f45;--nv3:#243447;
            --or:#f47c20;--or2:#d96a10;--or3:#ff9040;
            --wh:#ffffff;--of:#f7f8fa;--lt:#eef1f5;
            --gy:#6b7280;--md:#374151;--dk:#111827;
            --gd:#d4af37;--sv:#94a3b8;--bz:#cd7f32;
        }
        *{margin:0;padding:0;box-sizing:border-box;}
        html{scroll-behavior:smooth;}
        body{font-family:'Poppins',sans-serif;background:#fff;color:var(--dk);overflow-x:hidden;}

        /* ===== TOPBAR ===== */
        .topbar{background:var(--nv);padding:8px 48px;display:flex;justify-content:space-between;align-items:center;font-size:12px;position:fixed;width:100%;top:0;z-index:1000;color:rgba(255,255,255,.7);}
        .topbar a{color:rgba(255,255,255,.85);text-decoration:none;transition:color .2s;}
        .topbar a:hover{color:var(--or);}
        .tbl,.tbr{display:flex;align-items:center;gap:14px;}
        .tbr{gap:18px;}

        /* ===== NAV ===== */
        nav{background:#fff;padding:0 48px;position:fixed;top:37px;width:100%;z-index:999;display:flex;align-items:center;justify-content:space-between;height:70px;border-bottom:1px solid rgba(0,0,0,.07);box-shadow:0 2px 24px rgba(0,0,0,.07); transition: all 0.3s ease;}
        .logo{display:flex;align-items:center;gap:12px;text-decoration:none;}
        .lico{width:44px;height:44px;background:linear-gradient(135deg,var(--or),var(--or2));border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:19px;color:#fff;box-shadow:0 4px 14px rgba(244,124,32,.35);}
        .lmain{font-size:22px;font-weight:800;color:var(--nv);display:block;line-height:1;letter-spacing:.5px;}
        .lsub{font-size:9px;color:var(--or);letter-spacing:3.5px;font-weight:700;text-transform:uppercase;display:block;}
        .nlinks{display:flex;align-items:center;gap:2px;}
        .nb{color:var(--md);background:none;border:none;font-family:'Poppins',sans-serif;font-size:13.5px;font-weight:500;padding:9px 15px;border-radius:7px;cursor:pointer;transition:all .2s;position:relative;text-decoration:none;}
        .nb:hover{color:var(--nv);background:var(--lt);}
        .nb.active{color:var(--or);font-weight:700;}
        .nb.active::after{content:'';position:absolute;bottom:-1px;left:15px;right:15px;height:2px;background:var(--or);border-radius:2px;}
        .nb.cta{background:linear-gradient(135deg,var(--or),var(--or2));color:#fff;font-weight:700;box-shadow:0 4px 14px rgba(244,124,32,.3);margin-left:10px;}
        .nb.cta:hover{background:linear-gradient(135deg,var(--or2),#c05e0e);transform:translateY(-1px);}
        .hbtn{display:none;font-size:22px;color:var(--nv);cursor:pointer;background:none;border:none;padding:8px;}

        /* ===== MOBILE MENU ===== */
        .mob{display:none;position:fixed;top:107px;left:0;right:0;background:#fff;z-index:998;padding:16px 24px 22px;border-bottom:3px solid var(--or);flex-direction:column;box-shadow:0 10px 40px rgba(0,0,0,.12);}
        .mob.open{display:flex;}
        .mob a{color:var(--md);text-decoration:none;font-family:'Poppins',sans-serif;font-size:15px;font-weight:500;padding:13px 0;border-bottom:1px solid var(--lt);text-align:left;cursor:pointer;width:100%;transition:color .2s;}
        .mob a:hover{color:var(--or);}
        .mob a:last-child{border-bottom:none;}

        /* ===== LAYOUT ===== */
        section{padding:88px 0;}
        .wrap{max-width:1180px;margin:0 auto;padding:0 44px;}
        .lbl{font-size:11px;font-weight:700;letter-spacing:4px;text-transform:uppercase;color:var(--or);margin-bottom:12px;display:flex;align-items:center;gap:10px;}
        .lbl::before{content:'';display:block;width:28px;height:2px;background:var(--or);border-radius:2px;}
        .lbl.c{justify-content:center;}
        h2.ttl{font-size:clamp(28px, 3.5vw, 46px);font-weight:800;line-height:1.1;color:var(--nv);margin-bottom:14px;}
        .dsc{font-size:15px;color:var(--gy);line-height:1.9;max-width:600px;}
        .tc{text-align:center;}
        .tc .dsc{margin:0 auto;}

        /* ===== BUTTONS ===== */
        .bo{background:linear-gradient(135deg,var(--or),var(--or2));color:#fff;padding:13px 28px;border:none;font-family:'Poppins',sans-serif;font-size:14px;font-weight:700;cursor:pointer;display:inline-flex;align-items:center;gap:9px;border-radius:8px;transition:all .25s;text-decoration:none;box-shadow:0 4px 16px rgba(244,124,32,.3);}
        .bo:hover{transform:translateY(-2px);box-shadow:0 8px 24px rgba(244,124,32,.4);}
        .bn{background:var(--nv);color:#fff;padding:13px 28px;border:none;font-family:'Poppins',sans-serif;font-size:14px;font-weight:700;cursor:pointer;display:inline-flex;align-items:center;gap:9px;border-radius:8px;transition:all .25s;text-decoration:none;}
        .bn:hover{background:var(--nv2);transform:translateY(-2px);}
        .bw{background:transparent;color:var(--nv);padding:12px 26px;border:2px solid rgba(13, 27, 42, 0.2);font-family:'Poppins',sans-serif;font-size:14px;font-weight:600;cursor:pointer;display:inline-flex;align-items:center;gap:9px;border-radius:8px;transition:all .25s;text-decoration:none;}
        .bw:hover{border-color:var(--or);color:var(--or);}
        
        /* White version for dark backgrounds */
        .bw-white { color:#fff; border-color:rgba(255,255,255,0.3); }
        .bw-white:hover { border-color:var(--or); color:var(--or); }

        /* ===== FOOTER ===== */
        footer{background:var(--nv);color:rgba(255,255,255,.65);padding:66px 0 0;}
        .fg4{display:grid;grid-template-columns:2fr 1fr 1fr 1.2fr;gap:36px;}
        .fb p{font-size:13px;line-height:1.85;margin:15px 0 20px;color:rgba(255,255,255,.48);}
        .flogo{display:flex;align-items:center;gap:11px; text-decoration: none;}
        .ficon{width:38px;height:38px;background:linear-gradient(135deg,var(--or),var(--or2));border-radius:9px;display:flex;align-items:center;justify-content:center;font-size:16px;color:#fff;}
        .fmain{font-size:20px;font-weight:800;color:#fff;display:block;line-height:1;}
        .fsub{font-size:9px;color:var(--or);letter-spacing:3px;font-weight:700;text-transform:uppercase;display:block;}
        .socs{display:flex;gap:8px;}
        .soc{width:35px;height:35px;background:rgba(255,255,255,.07);border-radius:7px;display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,.55);font-size:13px;text-decoration:none;transition:all .25s;}
        .soc:hover{background:var(--or);color:#fff;transform:translateY(-2px);}
        .fc h4{font-size:10.5px;font-weight:700;letter-spacing:2.5px;text-transform:uppercase;color:#fff;margin-bottom:18px;}
        .fc ul{list-style:none;}
        .fc ul li{margin-bottom:9px;}
        .fc ul li a{color:rgba(255,255,255,.52);text-decoration:none;font-size:13px;transition:color .2s;}
        .fc ul li a:hover{color:var(--or);}
        .fbot{margin-top:50px;padding:18px 44px;border-top:1px solid rgba(255,255,255,.07); font-size: 13px;}
        .fbot em{color:var(--or);font-style:normal;}

        /* Animations & Advancements */
        .hover-lift { transition: transform 0.3s ease, box-shadow 0.3s ease; }
        .hover-lift:hover { transform: translateY(-5px); box-shadow: 0 10px 25px rgba(0,0,0,0.1); }
        
        .glass-card { background: rgba(255, 255, 255, 0.05); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.1); }

        /* ===== WHATSAPP FLOAT ===== */
        .wa-float { position: fixed; bottom: 30px; left: 30px; width: 60px; height: 60px; background: #25d366; color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 32px; box-shadow: 0 10px 25px rgba(37,211,102,0.35); z-index: 1001; transition: all 0.3s; text-decoration: none; }
        .wa-float:hover { transform: scale(1.1) translateY(-5px); background: #20ba5a; color: #fff; }
        .wa-badge { position: absolute; top: -5px; right: -5px; background: #ff3b30; color: #fff; width: 20px; height: 20px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 11px; font-weight: 700; border: 2px solid #fff; animation: pulse 2s infinite; }
        @keyframes pulse { 0% { transform: scale(1); } 50% { transform: scale(1.2); } 100% { transform: scale(1); } }

        /* ===== MEGA PROMO MODAL — PREMIUM SPLIT DESIGN ===== */
        .promo-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(5,15,30,0.95); z-index: 3000; display: none; align-items: center; justify-content: center; backdrop-filter: blur(20px); padding: 20px; }
        @keyframes modalPop { from { transform: translateY(60px) scale(0.92); opacity: 0; } to { transform: translateY(0) scale(1); opacity: 1; } }
        @keyframes shimmer { 0%,100% { opacity:.06; } 50% { opacity:.13; } }

        .promo-card {
            display: grid; grid-template-columns: 340px 1fr;
            width: 100%; max-width: 1100px; max-height: 88vh;
            border-radius: 28px; overflow: hidden; position: relative;
            box-shadow: 0 60px 140px rgba(0,0,0,0.6), 0 0 0 1px rgba(244,124,32,0.3);
            animation: modalPop 0.55s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        /* LEFT PANEL */
        .promo-left {
            background: linear-gradient(160deg, #0d1b2a 0%, #1a3050 60%, #0d1b2a 100%);
            padding: 50px 36px; display: flex; flex-direction: column; justify-content: space-between;
            position: relative; overflow: hidden;
        }
        .promo-left::before {
            content:''; position:absolute; top:-80px; left:-80px; width:320px; height:320px;
            background: radial-gradient(circle, rgba(244,124,32,0.25) 0%, transparent 70%);
            animation: shimmer 4s ease-in-out infinite;
        }
        .promo-left::after {
            content:''; position:absolute; bottom:-60px; right:-60px; width:240px; height:240px;
            background: radial-gradient(circle, rgba(244,124,32,0.15) 0%, transparent 70%);
            animation: shimmer 4s ease-in-out infinite reverse;
        }
        .promo-badge {
            display: inline-flex; align-items: center; gap: 8px;
            background: rgba(244,124,32,0.15); border: 1px solid rgba(244,124,32,0.4);
            color: var(--or); font-size: 11px; font-weight: 700; letter-spacing: 2.5px;
            text-transform: uppercase; padding: 7px 14px; border-radius: 50px;
            width: fit-content; margin-bottom: 28px; position: relative; z-index:2;
        }
        .promo-badge span { width:6px; height:6px; background:var(--or); border-radius:50%; animation: pulse 1.5s infinite; }
        .promo-left h2 { font-size: 30px; font-weight: 900; color: #fff; line-height: 1.25; margin-bottom: 16px; position: relative; z-index:2; }
        .promo-left h2 em { color: var(--or); font-style: normal; display:block; }
        .promo-left p { font-size: 13.5px; color: rgba(255,255,255,0.6); line-height: 1.75; margin-bottom: 30px; position: relative; z-index:2; }
        .promo-stats { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; position: relative; z-index:2; }
        .promo-stat { background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); border-radius: 14px; padding: 14px; text-align: center; }
        .promo-stat strong { display:block; font-size: 20px; font-weight: 900; color: var(--or); }
        .promo-stat span { font-size: 10px; color: rgba(255,255,255,0.5); text-transform: uppercase; letter-spacing: 1px; }
        .promo-trust { display:flex; align-items:center; gap:8px; color:rgba(255,255,255,0.4); font-size:11px; margin-top:24px; position:relative; z-index:2; }
        .promo-trust i { color: var(--or); }

        /* RIGHT PANEL */
        .promo-right {
            background: #f7f8fa; overflow-y: auto; position: relative;
            scrollbar-width: thin; scrollbar-color: var(--or) #eee;
        }
        .promo-right::-webkit-scrollbar { width: 6px; }
        .promo-right::-webkit-scrollbar-track { background: #eee; }
        .promo-right::-webkit-scrollbar-thumb { background: var(--or); border-radius: 10px; }
        .promo-right-inner { padding: 36px 32px; }

        .promo-close-btn {
            position: absolute; top: 18px; right: 18px; z-index: 100;
            background: rgba(13,27,42,0.08); border: none; width: 36px; height: 36px;
            border-radius: 50%; display: flex; align-items:center; justify-content:center;
            cursor: pointer; font-size: 16px; color: var(--nv); transition: all 0.3s;
        }
        .promo-close-btn:hover { background: var(--or); color: #fff; transform: rotate(90deg); }

        /* PACKAGE CARDS inside popup */
        .promo-pkg-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; margin-bottom: 20px; }
        .promo-pkg { background:#fff; border:1.5px solid #e8ecf0; border-radius:18px; padding:20px 18px; position:relative; cursor:pointer; transition: all 0.3s; display:flex; flex-direction:column; }
        .promo-pkg:hover { border-color: var(--or); box-shadow: 0 12px 35px rgba(244,124,32,0.12); transform: translateY(-3px); }
        .promo-pkg.pop { border-color: var(--or); box-shadow: 0 8px 25px rgba(244,124,32,0.15); }
        .promo-pkg-tag { position:absolute; top:12px; right:12px; background:var(--of); color:var(--nv); font-size:9px; font-weight:800; padding:3px 10px; border-radius:50px; text-transform:uppercase; letter-spacing:1px; }
        .promo-pkg.pop .promo-pkg-tag { background:var(--or); color:#fff; }
        .promo-pkg h4 { font-size:14px; font-weight:800; color:var(--nv); margin-bottom:4px; }
        .promo-pkg-price { font-size:20px; font-weight:900; color:var(--nv); margin-bottom:12px; }
        .promo-pkg-price span { font-size:11px; color:var(--gy); font-weight:500; }
        .promo-pkg ul { list-style:none; padding:0; margin:0 0 16px; flex:1; }
        .promo-pkg ul li { font-size:11.5px; color:var(--gy); margin-bottom:6px; display:flex; align-items:center; gap:7px; }
        .promo-pkg ul li i { color:var(--or); font-size:9px; }
        .promo-pkg-btn { background:var(--nv); color:#fff; border:none; padding:10px; border-radius:10px; font-weight:700; font-size:12px; cursor:pointer; width:100%; transition:all 0.3s; }
        .promo-pkg-btn.or { background:var(--or); }
        .promo-pkg-btn:hover { background:#000; }

        .promo-toggle { display:flex; background:#fff; border-radius:50px; padding:5px; border:1px solid #e8ecf0; margin-bottom:20px; width:fit-content; }
        .promo-toggle-btn { padding:8px 22px; border:none; background:transparent; font-weight:700; font-size:12.5px; color:var(--gy); cursor:pointer; border-radius:50px; transition:all 0.3s; }
        .promo-toggle-btn.active { background:var(--nv); color:#fff; box-shadow:0 4px 12px rgba(13,27,42,0.2); }

        .promo-section-title { font-size:11px; font-weight:800; letter-spacing:2px; text-transform:uppercase; color:var(--gy); margin-bottom:14px; display:flex; align-items:center; gap:8px; }
        .promo-section-title::before { content:''; width:20px; height:2px; background:var(--or); border-radius:2px; }

        .promo-addons { display:grid; grid-template-columns: repeat(3,1fr); gap:10px; }
        .promo-addon { background:#fff; border:1.5px solid #e8ecf0; border-radius:14px; padding:14px 12px; text-align:center; cursor:pointer; transition:all 0.3s; }
        .promo-addon:hover { border-color:var(--or); }
        .promo-addon h5 { font-size:12px; color:var(--nv); margin-bottom:4px; }
        .promo-addon-price { font-size:14px; font-weight:800; color:var(--or); }

        @media(max-width:820px){
            .promo-card { grid-template-columns: 1fr; max-height: 92vh; }
            .promo-left { padding: 30px 24px; }
            .promo-stats { grid-template-columns: repeat(4,1fr); }
            .promo-pkg-grid { grid-template-columns: 1fr; }
            .promo-addons { grid-template-columns: 1fr 1fr; }
        }

        /* MIGRATE SERVICES CSS */
        .toggle-btn { padding: 12px 35px; border: none; background: transparent; color: var(--gy); font-weight: 700; font-size: 15px; cursor: pointer; border-radius: 50px; transition: all 0.3s; }
        .toggle-btn.active { background: var(--nv); color: #fff; box-shadow: 0 5px 15px rgba(13, 27, 42, 0.2); }
        .pkg-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 30px; }
        .pkg-card { background: #fff; padding: 40px 30px; border-radius: 30px; border: 1px solid #eee; position: relative; transition: all 0.4s; display: flex; flex-direction: column; text-align: left; }
        .pkg-card:hover { transform: translateY(-10px); box-shadow: 0 30px 60px rgba(0,0,0,0.08); border-color: var(--or); }
        .pkg-card.popular { border: 2px solid var(--or); box-shadow: 0 30px 60px rgba(244, 124, 32, 0.1); }
        .pkg-badge { position: absolute; top: 20px; right: 25px; background: var(--of); color: var(--nv); padding: 5px 15px; border-radius: 50px; font-size: 11px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; }
        .pkg-card.popular .pkg-badge { background: var(--or); color: #fff; }
        .pkg-card-head h3 { font-size: 22px; color: var(--nv); margin-bottom: 10px; }
        .pkg-price { font-size: 32px; font-weight: 900; color: var(--nv); margin-bottom: 25px; }
        .pkg-price span { font-size: 14px; color: var(--gy); font-weight: 600; }
        .pkg-breakdown { background: #fcfcfc; padding: 15px; border-radius: 15px; margin-bottom: 25px; border: 1px dashed #eee; }
        .br-row { display: flex; justify-content: space-between; font-size: 12px; margin-bottom: 5px; color: var(--gy); }
        .br-row span:last-child { font-weight: 700; color: var(--nv); }
        .pkg-list { list-style: none; padding: 0; margin: 0 0 30px 0; flex: 1; }
        .pkg-list li { font-size: 14px; color: var(--gy); margin-bottom: 12px; display: flex; align-items: center; gap: 12px; }
        .pkg-list li i { color: var(--or); font-size: 12px; }
        .book-btn { display: flex; align-items: center; justify-content: center; gap: 10px; background: var(--nv); color: #fff; text-decoration: none; padding: 15px; border-radius: 15px; font-weight: 700; transition: all 0.3s; width: 100%; cursor: pointer; border: none; }
        .book-btn.orange { background: var(--or); }
        .book-btn:hover { background: #000; color: #fff; }
        .add-on-box { background: #fff; padding: 30px; border-radius: 20px; border: 1px solid #eee; transition: all 0.3s; cursor: pointer; text-align: center; }
        .add-on-box:hover { border-color: var(--or); background: #fffaf7; }
        .add-on-box h4 { margin-bottom: 10px; color: var(--nv); }
        .add-on-price { font-size: 24px; font-weight: 800; color: var(--or); margin-bottom: 5px; }

        /* ===== BOOKING MODAL ===== */
        .modal-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(13,27,42,0.8); z-index: 2000; display: none; align-items: center; justify-content: center; backdrop-filter: blur(8px); padding: 20px; }
        .modal-content { background: #fff; width: 100%; max-width: 900px; max-height: 90vh; border-radius: 30px; overflow-y: auto; position: relative; box-shadow: 0 30px 60px rgba(0,0,0,0.5); }

        /* ===== FULL SLA OVERLAY ===== */
        #slaOverlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: #fff; z-index: 4000; display: none; overflow-y: auto; padding: 60px 20px; animation: slideInUp 0.4s ease; }
        @keyframes slideInUp { from { transform: translateY(100%); } to { transform: translateY(0); } }
        .close-sla { position: fixed; top: 20px; right: 30px; background: var(--nv); color: #fff; border: none; padding: 10px 20px; border-radius: 50px; cursor: pointer; z-index: 4100; font-weight: 700; box-shadow: 0 4px 15px rgba(0,0,0,0.2); }
        .close-sla:hover { background: var(--or); }
        .sla-document { max-width: 900px; margin: 0 auto; background: #fff; padding: 50px; box-shadow: 0 0 40px rgba(0,0,0,0.05); border: 1px solid #eee; font-family: 'Times New Roman', Times, serif; color: #000; line-height: 1.8; text-align: justify; }
        .modal-header { background: var(--nv); color: #fff; padding: 30px 40px; position: sticky; top: 0; z-index: 10; display: flex; justify-content: space-between; align-items: center; }
        .form-section { padding: 30px 40px; }
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 30px; }
        .form-group { margin-bottom: 15px; position: relative; }
        .form-group label { display: block; font-size: 12px; font-weight: 700; text-transform: uppercase; color: var(--gy); margin-bottom: 8px; letter-spacing: 0.5px; }
        .form-group label.req::after { content: ' *'; color: #ff3b30; }
        .form-group input, .form-group select, .form-group textarea { width: 100%; padding: 12px 15px; border: 1px solid #e2e8f0; border-radius: 10px; font-family: inherit; font-size: 14px; transition: all 0.3s; }
        .form-group input:focus { border-color: var(--or); outline: none; }
        .form-group input.error { border-color: var(--or) !important; background: #fff5f5 !important; box-shadow: 0 0 5px rgba(244,124,32,0.3); }
        .input-error-shake { border-color: var(--or) !important; background: #fff5f5 !important; animation: shake 0.4s; }
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }
        .validation-tip { position: absolute; background: var(--or); color: #fff; padding: 4px 10px; border-radius: 6px; font-size: 10px; font-weight: 700; z-index: 100; pointer-events: none; animation: fadeInOut 1.5s forwards; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        @keyframes fadeInOut {
            0% { opacity: 0; transform: translateY(10px); }
            20% { opacity: 1; transform: translateY(0); }
            80% { opacity: 1; transform: translateY(0); }
            100% { opacity: 0; transform: translateY(-10px); }
        }
        .office-use { background: #cbd5e1; border: 2px dashed #94a3b8; padding: 25px; border-radius: 20px; margin-top: 30px; pointer-events: none; opacity: 0.8; position: relative; }
        .office-use::after { content: 'FOR OFFICE PURPOSE ONLY'; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%) rotate(-15deg); font-size: 30px; font-weight: 900; color: rgba(0,0,0,0.05); }
        
        @media(max-width:660px){
            .premium-popup { left: 20px; right: 20px; flex-direction: column; text-align: center; }
            .form-grid { grid-template-columns: 1fr; }
        }
    </style>
    @yield('styles')
</head>
<body>

<!-- MEGA PROMO MODAL — HOME PAGE ONLY -->
@if(request()->routeIs('home'))
<div class="promo-overlay" id="megaPromo">
    <!-- LEFT PANEL — Branding -->
    <div class="promo-left">
        <div>
            <div class="promo-badge"><span></span> Special Offer — 2025</div>
            <h2>Choose Your<em>Tracking Package</em></h2>
            <p>Pakistan's most trusted GPS vehicle tracking since 2009. Real-time monitoring, 24/7 support — your vehicle's safety is our priority.</p>
            <div class="promo-stats">
                <div class="promo-stat"><strong>15+</strong><span>Years Active</span></div>
                <div class="promo-stat"><strong>5000+</strong><span>Vehicles</span></div>
                <div class="promo-stat"><strong>24/7</strong><span>Monitoring</span></div>
                <div class="promo-stat"><strong>100%</strong><span>Secure</span></div>
            </div>
            <div class="promo-trust"><i class="fas fa-shield-alt"></i> ESS-TRACK by ESSPL — Certified & Trusted</div>
        </div>
        <a href="{{ route('services') }}" onclick="closePromo()" style="margin-top:28px; display:inline-flex; align-items:center; gap:8px; background:var(--or); color:#fff; padding:13px 24px; border-radius:12px; font-weight:700; font-size:13px; text-decoration:none; transition:all 0.3s; position:relative; z-index:2;">
            View All Packages <i class="fas fa-arrow-right"></i>
        </a>
    </div>

    <!-- RIGHT PANEL — Packages -->
    <div class="promo-right">
        <button class="promo-close-btn" onclick="closePromo()"><i class="fas fa-times"></i></button>
        <div class="promo-right-inner">

            <!-- Toggle -->
            <div class="promo-toggle">
                <button id="promoRentalBtn" class="promo-toggle-btn active" onclick="showPromoPackages('rental')">Rental</button>
                <button id="promoDeviceBtn" class="promo-toggle-btn" onclick="showPromoPackages('device')">With Device</button>
            </div>

            <!-- RENTAL GRID -->
            <div id="promoRentalGrid">
                <p class="promo-section-title">Rental Packages</p>
                <div class="promo-pkg-grid">
                    <div class="promo-pkg" onclick="window.location.href='{{ route('services') }}'">
                        <div class="promo-pkg-tag">Starter</div>
                        <h4>Basic / Silver</h4>
                        <div class="promo-pkg-price">PKR 14,500<span>/Total</span></div>
                        <ul>
                            <li><i class="fas fa-check"></i> 24/7 Control Room</li>
                            <li><i class="fas fa-check"></i> Geo Fence Alerts</li>
                            <li><i class="fas fa-check"></i> Remote Shutdown</li>
                            <li><i class="fas fa-check"></i> Data Plan Included</li>
                        </ul>
                        <button class="promo-pkg-btn" onclick="event.stopPropagation(); closePromo(); openBookingModal('Basic / Silver Rental')">Book Now</button>
                    </div>
                    <div class="promo-pkg pop" onclick="window.location.href='{{ route('services') }}'">
                        <div class="promo-pkg-tag">Most Popular</div>
                        <h4>Standard / Gold</h4>
                        <div class="promo-pkg-price">PKR 18,500<span>/Total</span></div>
                        <ul>
                            <li><i class="fas fa-plus"></i> All Silver Features</li>
                            <li><i class="fas fa-check"></i> European Software</li>
                            <li><i class="fas fa-check"></i> Live Map Status</li>
                            <li><i class="fas fa-check"></i> Mobile App FREE</li>
                        </ul>
                        <button class="promo-pkg-btn or" onclick="event.stopPropagation(); closePromo(); openBookingModal('Standard / Gold Rental')">Book Now</button>
                    </div>
                    <div class="promo-pkg" onclick="window.location.href='{{ route('services') }}'">
                        <div class="promo-pkg-tag">Advanced</div>
                        <h4>Premium / Platinum</h4>
                        <div class="promo-pkg-price">PKR 35,000<span>/Total</span></div>
                        <ul>
                            <li><i class="fas fa-plus"></i> All Gold Features</li>
                            <li><i class="fas fa-check"></i> Auto Calls Alert</li>
                            <li><i class="fas fa-check"></i> Dedicated Manager</li>
                            <li><i class="fas fa-check"></i> Maintenance Alerts</li>
                        </ul>
                        <button class="promo-pkg-btn" onclick="event.stopPropagation(); closePromo(); openBookingModal('Premium / Platinum Rental')">Book Now</button>
                    </div>
                    <div class="promo-pkg" onclick="window.location.href='{{ route('services') }}'">
                        <div class="promo-pkg-tag">Bulk Fleet</div>
                        <h4>Corporate Fleet</h4>
                        <div class="promo-pkg-price">PKR 18,500<span>/Vehicle</span></div>
                        <ul>
                            <li><i class="fas fa-snowflake"></i> Reefer Trucks</li>
                            <li><i class="fas fa-check"></i> Temp Monitoring</li>
                            <li><i class="fas fa-check"></i> Custom Dashboards</li>
                            <li><i class="fas fa-check"></i> Staff Training</li>
                        </ul>
                        <button class="promo-pkg-btn" onclick="event.stopPropagation(); closePromo(); openBookingModal('Corporate Fleet Rental')">Book Now</button>
                    </div>
                </div>
            </div>

            <!-- DEVICE GRID -->
            <div id="promoDeviceGrid" style="display:none;">
                <p class="promo-section-title">With Device Packages</p>
                <div class="promo-pkg-grid">
                    <div class="promo-pkg">
                        <h4>Basic / Silver</h4>
                        <div class="promo-pkg-price">PKR 27,000<span>/Total</span></div>
                        <ul>
                            <li><i class="fas fa-check"></i> Full Device Ownership</li>
                            <li><i class="fas fa-check"></i> 24/7 Monitoring</li>
                            <li><i class="fas fa-check"></i> Remote Shutdown</li>
                        </ul>
                        <button class="promo-pkg-btn" onclick="closePromo(); openBookingModal('Basic / Silver Device')">Book Now</button>
                    </div>
                    <div class="promo-pkg pop">
                        <h4>Standard / Gold</h4>
                        <div class="promo-pkg-price">PKR 31,000<span>/Total</span></div>
                        <ul>
                            <li><i class="fas fa-check"></i> European Software</li>
                            <li><i class="fas fa-check"></i> Engine Alerts</li>
                            <li><i class="fas fa-check"></i> Trip History</li>
                        </ul>
                        <button class="promo-pkg-btn or" onclick="closePromo(); openBookingModal('Standard / Gold Device')">Book Now</button>
                    </div>
                    <div class="promo-pkg">
                        <h4>Premium / Platinum</h4>
                        <div class="promo-pkg-price">PKR 36,500<span>/Total</span></div>
                        <ul>
                            <li><i class="fas fa-check"></i> Voice Monitoring</li>
                            <li><i class="fas fa-check"></i> Dedicated Manager</li>
                            <li><i class="fas fa-check"></i> Access Shutdown</li>
                        </ul>
                        <button class="promo-pkg-btn" onclick="closePromo(); openBookingModal('Premium / Platinum Device')">Book Now</button>
                    </div>
                </div>
            </div>

            <!-- Add-ons -->
            <div style="margin-top:24px;">
                <p class="promo-section-title">Add-on Devices</p>
                <div class="promo-addons">
                    <div class="promo-addon" onclick="closePromo(); openBookingModal('Dash Cam Tracker Add-on')">
                        <h5>Dash Cam</h5>
                        <div class="promo-addon-price">PKR 45,000</div>
                    </div>
                    <div class="promo-addon" onclick="closePromo(); openBookingModal('AI Dash Cam Add-on')">
                        <h5>AI Dash Cam</h5>
                        <div class="promo-addon-price">PKR 120,000</div>
                    </div>
                    <div class="promo-addon" onclick="closePromo(); openBookingModal('Temperature Sensor Add-on')">
                        <h5>Temp Sensor</h5>
                        <div class="promo-addon-price">PKR 6,500</div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endif


<div class="topbar">
    <div class="tbl"><i class="fas fa-phone-volume" style="color:var(--or);margin-right:5px"></i><a href="tel:02134330887">021-34330887-88</a></div>
    <div class="tbr"><i class="fas fa-envelope" style="color:var(--or)"></i><a href="mailto:info@esspl.com.pk">info@esspl.com.pk</a><span style="opacity:.25">|</span><i class="fas fa-map-marker-alt" style="color:var(--or)"></i><span>Suit 201, Kawish Crown PECHS, Karachi</span></div>
</div>

<nav id="mainNav">
    <a href="{{ route('home') }}" class="logo">
        <div class="lico"><i class="fas fa-location-dot"></i></div>
        <div><span class="lmain">ESS-TRACK</span><span class="lsub">by ESSPL</span></div>
    </a>
    <div class="nlinks">
        <a href="{{ route('home') }}" class="nb {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
        <a href="{{ route('tracker') }}" class="nb {{ request()->routeIs('tracker') ? 'active' : '' }}">Vehicle Tracker</a>
        <a href="{{ route('services') }}" class="nb {{ request()->routeIs('services') ? 'active' : '' }}">Packages</a>
        <a href="{{ route('about') }}" class="nb {{ request()->routeIs('about') ? 'active' : '' }}">About Us</a>
        <a href="{{ route('contact') }}" class="nb cta">Contact Us</a>
    </div>
    <button class="hbtn" onclick="toggleMobileMenu()"><i class="fas fa-bars"></i></button>
</nav>

<div class="mob" id="mobMenu">
    <a href="{{ route('home') }}" onclick="toggleMobileMenu()">Home</a>
    <a href="{{ route('tracker') }}" onclick="toggleMobileMenu()">Vehicle Tracker</a>
    <a href="{{ route('services') }}" onclick="toggleMobileMenu()">Packages</a>
    <a href="{{ route('about') }}" onclick="toggleMobileMenu()">About Us</a>
    <a href="{{ route('contact') }}" onclick="toggleMobileMenu()">Contact Us</a>
</div>

<main>
    @yield('content')
</main>

<footer>
    <div class="wrap">
        <div class="fg4">
            <div class="fb">
                <a href="{{ route('home') }}" class="flogo">
                    <div class="ficon"><i class="fas fa-location-dot"></i></div>
                    <div><span class="fmain">ESS-TRACK</span><span class="fsub">by ESSPL</span></div>
                </a>
                <p>Electronic Safety & Security Pvt. Ltd.  Pakistan's trusted GPS vehicle tracking company since 2009.</p>
                <div class="socs">
                    <a href="https://www.facebook.com/ESSTRACKPAKISTAN" target="_blank" class="soc"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://wa.me/923342011104?text=Hey%2C%20can%20I%20get%20more%20info%20about%20packages%3F" target="_blank" class="soc"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>
            <div class="fc">
                <h4>Pages</h4>
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('tracker') }}">Vehicle Tracker</a></li>
                    <li><a href="{{ route('services') }}">Packages</a></li>
                    <li><a href="{{ route('about') }}">About Us</a></li>
                    <li><a href="{{ route('contact') }}">Contact Us</a></li>
                </ul>
            </div>
            <div class="fc">
                <h4>Our Packages</h4>
                <ul>
                    <li><a href="{{ route('services') }}">Basic Package</a></li>
                    <li><a href="{{ route('services') }}">Silver Package</a></li>
                    <li><a href="{{ route('services') }}">Gold Package</a></li>
                </ul>
            </div>
            <div class="fc">
                <h4>Contact Info</h4>
                <ul>
                    <li><a href="tel:02134330887"><i class="fas fa-phone" style="color:var(--or);margin-right:6px"></i>021-34330887-88</a></li>
                    <li><a href="mailto:info@esspl.com.pk"><i class="fas fa-envelope" style="color:var(--or);margin-right:6px"></i>info@esspl.com.pk</a></li>
                    <li><a href="https://www.esspl.com.pk" target="_blank"><i class="fas fa-globe" style="color:var(--or);margin-right:6px"></i>www.esspl.com.pk</a></li>
                    <li><span><i class="fas fa-map-marker-alt" style="color:var(--or);margin-right:6px"></i>Suit 201, Kawish Crown, Block 6 PECHS, Karachi</span></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="fbot">
        <div class="wrap" style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:8px">
            <span>&copy; {{ date('Y') }} <em>ESS-TRACK BY ESSPL</em>. All rights reserved.</span>
            <span>Electronic Safety & Security Pvt. Ltd.</span>
        </div>
    </div>
</footer>



<!-- BOOKING MODAL -->
<div class="modal-overlay" id="bookingModal">
    <div class="modal-content" style="max-width: 1000px;">
        <div class="modal-header">
            <div style="display: flex; align-items: center; gap: 20px;">
                <div style="background: #fff; padding: 6px 12px; border-radius: 12px; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 10px rgba(0,0,0,0.1);"><img src="{{ asset('images/logo.png') }}" alt="ESS-TRACK Logo" style="height: 45px; object-fit: contain;"></div>
                <div>
                    <h2 style="font-size: 24px; font-weight: 800; line-height: 1.2;">Service Agreement</h2>
                    <p style="font-size: 13px; color: rgba(255,255,255,0.6);">ESS-TRACK BY ESSPL  Comprehensive Tracking Solutions</p>
                </div>
            </div>
            <button onclick="closeBookingModal()" style="background: rgba(255,255,255,0.1); border: none; color: #fff; width: 40px; height: 40px; border-radius: 50%; cursor: pointer;"><i class="fas fa-times"></i></button>
        </div>
        
        <div class="form-section" style="padding: 40px;">
            <form id="agreementForm">
                <!-- CUSTOMER DETAILS & NUMBERS -->
                <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 30px; margin-bottom: 30px;">
                    <div>
                        <h4 style="background: #000; color: #fff; padding: 8px 15px; margin-bottom: 15px; font-size: 14px;">Customer Details:</h4>
                        <div class="form-group"><label class="req">Name</label><input type="text" name="name" required placeholder="Full Name" oninput="this.value=this.value.replace(/[^A-Za-z\s]/g,'')" title="Only alphabets allowed"></div>
                        <div class="form-group"><label class="req">Vehicle No</label><input type="text" name="vehicle_no" required placeholder="ABC-1234" oninput="this.value=this.value.replace(/[^A-Za-z0-9\-]/g,'').toUpperCase()" title="Alphanumeric with dash e.g. ABC-1234"></div>
                        <div class="form-group"><label class="req">Residential Address</label><input type="text" name="res_address" required placeholder="Full Address" oninput="this.value=this.value.replace(/[^A-Za-z0-9\s,\.\-\/\#]/g,'')" title="Address: letters, numbers, spaces, commas allowed"></div>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                            <div class="form-group"><label>Postal Code</label><input type="text" name="postal_code" oninput="this.value=this.value.replace(/[^0-9]/g,'')" maxlength="5" placeholder="75400" title="Only numbers allowed"></div>
                            <div class="form-group"><label>Vehicle Type</label>
                                <div style="display: flex; gap: 10px; font-size: 12px; align-items: center; height: 40px;">
                                    <input type="radio" name="v_type" value="Private" checked> Private
                                    <input type="radio" name="v_type" value="Commercial"> Commercial
                                    <input type="radio" name="v_type" value="Other"> Other
                                </div>
                            </div>
                        </div>
                        <div class="form-group"><label>Commercial Address</label><input type="text" name="comm_address" oninput="this.value=this.value.replace(/[^A-Za-z0-9\s,\.\-\/\#]/g,'')" title="Address: letters, numbers, spaces, commas allowed"></div>
                    </div>
                    <div>
                        <h4 style="background: #000; color: #fff; padding: 8px 15px; margin-bottom: 15px; font-size: 14px;">Customer Numbers:</h4>
                        <div class="form-group"><label>Home</label><input type="tel" name="num_home" placeholder="021-34330887" oninput="this.value=this.value.replace(/[^0-9A-Za-z\-\s]/g,'')" title="Alphanumeric phone e.g. 021-34330887"></div>
                        <div class="form-group"><label>Office</label><input type="tel" name="num_office" placeholder="021-34330887" oninput="this.value=this.value.replace(/[^0-9A-Za-z\-\s]/g,'')" title="Alphanumeric phone e.g. 021-34330887"></div>
                        <div class="form-group">
                            <label class="req">Mobile</label>
                            <div style="display: flex; gap: 8px;">
                                <input type="tel" name="mobile" id="custMobile" required placeholder="03xxxxxxxxx" style="flex: 1;" oninput="this.value=this.value.replace(/[^0-9]/g,'')" maxlength="11" title="Only numbers, 11 digits e.g. 03001234567">
                                <button type="button" onclick="showOTPOptions()" class="bn" style="padding: 10px 15px; font-size: 11px; white-space: nowrap;">Get OTP</button>
                            </div>
                        </div>

                        <!-- OTP VERIFICATION SECTION -->
                        <div id="otpWrapper" style="display: none; background: #f0f4f8; padding: 15px; border-radius: 12px; border: 1px solid #cbd5e1; margin-bottom: 15px;">
                            <label style="font-size: 10px; font-weight: 800; color: var(--nv); margin-bottom: 10px; display: block; text-transform: uppercase;">Select OTP Method:</label>
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 12px;">
                                <button type="button" id="btnSms" onclick="sendOTP('SIM')" style="background: #fff; border: 1px solid #cbd5e1; padding: 10px; border-radius: 8px; cursor: pointer; font-size: 11px; font-weight: 600; transition: 0.3s; display: flex; align-items: center; justify-content: center; gap: 6px;">
                                    <i class="fas fa-sim-card" style="color: #64748b;"></i> Via SIM
                                </button>
                                <button type="button" id="btnWa" onclick="sendOTP('WhatsApp')" style="background: #fff; border: 1px solid #25d366; padding: 10px; border-radius: 8px; cursor: pointer; font-size: 11px; font-weight: 600; color: #25d366; transition: 0.3s; display: flex; align-items: center; justify-content: center; gap: 6px;">
                                    <i class="fab fa-whatsapp"></i> Via WhatsApp
                                </button>
                            </div>
                            
                            <div id="otpInputGroup" style="display: none;">
                                <div style="position: relative;">
                                    <input type="text" id="otpInput" maxlength="4" placeholder="____" style="text-align: center; letter-spacing: 12px; font-size: 20px; font-weight: 900; background: #fff; border: 2px solid var(--nv); padding: 10px;">
                                    <div id="otpTimer" style="font-size: 10px; color: var(--gy); margin-top: 5px; text-align: right;">Resend in <span id="timerSec">30</span>s</div>
                                </div>
                                <button type="button" onclick="verifyOTP()" class="bo" style="width: 100%; margin-top: 10px; background: var(--nv); font-size: 12px; padding: 12px;">Verify & Continue</button>
                            </div>
                            <div id="otpSuccess" style="display: none; color: #059669; font-weight: 700; font-size: 13px; text-align: center; padding: 10px;">
                                <i class="fas fa-check-circle"></i> Number Verified!
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="req">Email</label>
                            <input type="email" name="email" id="custEmail" required placeholder="email@example.com">
                        </div>
                    </div>
                </div>

                <!-- CONTACT FOR RESPONSE TABLE -->
                <h4 style="background: #000; color: #fff; padding: 8px 15px; margin-bottom: 10px; font-size: 14px;">Contact for response / events:</h4>
                <div style="overflow-x: auto; margin-bottom: 30px;">
                    <table style="width: 100%; border-collapse: collapse; font-size: 12px; text-align: left;">
                        <thead>
                            <tr style="background: #f1f5f9;">
                                <th style="border: 1px solid #ddd; padding: 8px;">#</th>
                                <th style="border: 1px solid #ddd; padding: 8px;">Name</th>
                                <th style="border: 1px solid #ddd; padding: 8px;">Relationship</th>
                                <th style="border: 1px solid #ddd; padding: 8px;">Key (Y/N)</th>
                                <th style="border: 1px solid #ddd; padding: 8px;">Residence</th>
                                <th style="border: 1px solid #ddd; padding: 8px;">Office</th>
                                <th style="border: 1px solid #ddd; padding: 8px;">Mobile</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for($i=1; $i<=7; $i++)
                            <tr>
                                <td style="border: 1px solid #ddd; padding: 5px;">C{{$i}}</td>
                                <td style="border: 1px solid #ddd; padding: 5px;"><input type="text" name="c{{$i}}_name" style="border:none; padding:5px; width:100%;" oninput="this.value=this.value.replace(/[^A-Za-z\s]/g,'')" title="Alphabets only"></td>
                                <td style="border: 1px solid #ddd; padding: 5px;"><input type="text" name="c{{$i}}_rel" style="border:none; padding:5px; width:100%;" oninput="this.value=this.value.replace(/[^A-Za-z\s]/g,'')" title="Alphabets only"></td>
                                <td style="border: 1px solid #ddd; padding: 5px;"><select name="c{{$i}}_key" style="border:none;"><option>Yes</option><option>No</option></select></td>
                                <td style="border: 1px solid #ddd; padding: 5px;"><input type="tel" name="c{{$i}}_res" style="border:none; padding:5px; width:100%;" oninput="this.value=this.value.replace(/[^0-9A-Za-z\-\s]/g,'')" placeholder="021-XXXXXXX" title="Alphanumeric phone"></td>
                                <td style="border: 1px solid #ddd; padding: 5px;"><input type="tel" name="c{{$i}}_off" style="border:none; padding:5px; width:100%;" oninput="this.value=this.value.replace(/[^0-9A-Za-z\-\s]/g,'')" placeholder="021-XXXXXXX" title="Alphanumeric phone"></td>
                                <td style="border: 1px solid #ddd; padding: 5px;"><input type="tel" name="c{{$i}}_mob" style="border:none; padding:5px; width:100%;" oninput="this.value=this.value.replace(/[^0-9]/g,'')" maxlength="11" placeholder="03XXXXXXXXX" title="Numbers only"></td>
                            </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>

                <!-- PRICING & OFFICE USE TABLE -->
                <div style="display: grid; grid-template-columns: 1.5fr 1fr; gap: 0; border: 1px solid #000; margin-bottom: 30px;">
                    <div style="border-right: 1px solid #000;">
                        <table style="width: 100%; border-collapse: collapse; font-size: 12px;">
                            <tr style="background: #000; color: #fff;">
                                <th style="padding: 8px; border: 1px solid #444;">Description</th>
                                <th style="padding: 8px; border: 1px solid #444;">Qty</th>
                                <th style="padding: 8px; border: 1px solid #444;">Rate</th>
                                <th style="padding: 8px; border: 1px solid #444;">Price</th>
                            </tr>
                            <tr>
                                <td style="padding: 10px; border: 1px solid #ddd;"><input type="text" id="selectedPkgField" name="pkg_description" readonly style="width:100%; border:none; font-weight:700;"></td>
                                <td style="padding: 10px; border: 1px solid #ddd; text-align:center;">1</td>
                                <td style="padding: 10px; border: 1px solid #ddd;"><input type="text" name="pkg_rate" style="width:100%; border:none;" onkeypress="return allowOnlyNumbers(event)"></td>
                                <td style="padding: 10px; border: 1px solid #ddd;"><input type="text" name="pkg_price" style="width:100%; border:none;" onkeypress="return allowOnlyNumbers(event)"></td>
                            </tr>
                            @for($i=0; $i<8; $i++)
                            <tr>
                                <td style="height:25px; border: 1px solid #ddd;">
                                    @if($i == 5) <div style="text-align:right; padding-right:10px; font-weight:700;">Monitoring Charges</div> @endif
                                    @if($i == 6) <div style="text-align:right; padding-right:10px; font-weight:700;">F.E.D. Charges</div> @endif
                                    @if($i == 7) <div style="text-align:right; padding-right:10px; font-weight:700;">Total</div> @endif
                                </td>
                                <td style="border: 1px solid #ddd;"></td>
                                <td style="border: 1px solid #ddd;"></td>
                                <td style="border: 1px solid #ddd;"></td>
                            </tr>
                            @endfor
                        </table>
                    </div>
                    <div style="background: #cbd5e1; padding: 20px; pointer-events: none; opacity: 0.8; position: relative; display: flex; flex-direction: column; justify-content: space-between; border-left: 1px solid #000;">
                        <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%) rotate(-15deg); font-size: 24px; font-weight: 900; color: rgba(0,0,0,0.1); width: 100%; text-align: center; pointer-events: none;">FOR OFFICE PURPOSE ONLY</div>
                        <div>
                            <h4 style="font-size: 14px; margin-bottom: 15px; border-bottom: 2px solid #94a3b8; padding-bottom: 5px; color: #1e293b; position: relative; z-index: 1;">For Office use Only</h4>
                            <div style="font-size: 11px; line-height: 2.2; color: #1e293b; font-weight: 600; position: relative; z-index: 1;">
                                Delivery Challan #: ___________<br>
                                Device IMEI #: _______________<br>
                                Sim #: ______________________<br>
                                Date of Kit Issue: ____________<br>
                                Uplink Date: _________________<br>
                                Comments: ___________________
                            </div>
                        </div>
                        <div style="border-top: 1px solid #94a3b8; padding-top: 10px; margin-top: 20px; position: relative; z-index: 1;">
                            <h4 style="font-size: 11px; color: #1e293b;">Yearly Standard Monitoring Fee:</h4>
                            <div style="font-size: 14px; font-weight: 800; color: #1e293b;">PKR ___________</div>
                        </div>
                    </div>
                </div>

                <!-- FORMALIZED AGREEMENT TEXT (SCROLLABLE INSIDE FORM) -->
                <div style="margin-bottom: 25px;">
                    <div style="display: flex; justify-content: space-between; align-items: center; background: #000; color: #fff; padding: 8px 15px;">
                        <h4 style="margin: 0; font-size: 14px;">Terms & Conditions of Service (SLA):</h4>
                        <a href="javascript:void(0)" onclick="openSLA()" style="color: var(--or); font-size: 12px; font-weight: 700; text-decoration: underline;">View Full Screen <i class="fas fa-expand"></i></a>
                    </div>
                    <div style="border: 1px solid #000; border-top: none; padding: 30px; font-size: 11px; line-height: 1.8; color: #111; height: 400px; overflow-y: scroll; background: #fff; font-family: 'Times New Roman', Times, serif; text-align: justify;">
                        <div style="text-align: center; margin-bottom: 30px;">
                            <span style="font-size: 14px; font-weight: 700;">1</span><br><br>
                            <h3 style="text-decoration: underline; margin-bottom: 10px; font-size: 18px; text-transform: uppercase;">SERVICE LEVEL AGREEMENT</h3>
                        </div>
                        
                        <p style="margin-bottom: 25px;">This Agreement is made between ESS TRACK (hereinafter referred to as the "service provider") and the user of the Tracking Service (hereinafter referred to as the "Customer"), which expression shall, where the context so permits, be deemed to include its successors and permitted assigns).</p>

                        <p><strong><u>1. Definitions</u></strong></p>
                        <p style="margin-bottom: 15px;">
                            "Agreement" means these terms and conditions.<br>
                            "Service provider" means ESS TRACK, company providing GPS tracking solutions.<br>
                            "Equipment" means GPS tracking device including each and every item of equipment described in the Monitoring Service Agreement as well as each or any replacement or substitute thereof all parts and components.<br>
                            "Carrier" means each and every related service provider/ law enforcement agencies, which provide essential services to enable "Service provider" to provide the services to the "customer".<br>
                            "Customer" means the person hired the services or the name on which Service Agreement is made and shall include the customer's authorized representative/s.<br>
                            "Commencement date" means the data on which the installation and the commissioning of the equipment on the premises had been completed.<br>
                            "Customer's Equipment" means the equipment and any other equipment owned by the customer listed in the Monitoring Service Agreement.<br>
                            "Service Warranty" means the warranty in clause 6.<br>
                            "Technician" mean person installing or visiting customer to resolve complains.<br>
                            "Initial Term" means the period of specified in service contract commencing from the date of uplink.<br>
                            "Installation Price" means the price specified in the Monitoring Service Agreement.<br>
                            "Monitoring Fee" means the fees specified or referred to in the Monitoring Service Agreement.<br>
                            "Vehicle" means the vehicle in which the equipment has to be installed.<br>
                            "Anti jammer" a device that shut downs the vehicle's engine if any Jamming device gets operational inside car; however, there is no 100% guarantee of its operations, neither 100% security of the vehicle Indemnity is claimed by ESS TRACK or its affiliates.
                        </p>

                        <p><strong><u>2. Installation</u></strong></p>
                        <p style="margin-bottom: 15px;">
                            1) "Service Provider" shall only install the equipment as per Monitoring Service Agreement and the installation shall be carried out during standard working hours, unless otherwise mutually agreed.<br>
                            2) For the purpose of installation, the customer shall provide complete access to his vehicle.<br>
                            3) Where the installation require additional unanticipated or unforeseen works beyond what was originally contemplated by Service Provider at the time of execution of the agreement, Service provider reserves the right to impose such other additional charges for such work.<br>
                            4) The service provider is not responsible of any impairment of vehicle at the time of installation.
                        </p>

                        <p><strong><u>3. Payment</u></strong></p>
                        <p style="margin-bottom: 15px;">
                            a) The customer shall pay service provider the amount shown in the Monitoring Service Agreement for installation, before the commencement date.<br>
                            b) The customer shall pay service provider throughout the agreement term, the monitoring fee in advance on quarter yearly or yearly basis.<br>
                            c) In Case of delay of monitoring charges the services would be temporary suspended after a prior notice.<br>
                            d) The customer shall pay all charges and fees charged by any carrier, which are properly payable in connection with the provision of service and shall keep service provider indemnified in this regard.<br>
                            e) Deposits for equipment will be return to customer once the service is terminated as per clause 7.<br>
                            f) Any duties and governing taxes shall be paid by the customer.<br>
                            g) Service provider shall charge a reasonable reconnection/ transfer of equipment charges.
                        </p>

                        <p><strong><u>4. Extension of Agreement Term</u></strong></p>
                        <p style="margin-bottom: 15px;">
                            1) Upon expiration of the initial term, if not informed through written notice by the customer to service provider for the termination, a 15 day notice will be served to customer for the disconnection of services prior to the disconnection and if there is no reply from customer then the agreement term shall be treated over and services will be disconnected, however, if the customer is out of reach then further grace period will be granted accordingly.<br>
                            2) Service provider has the right to increase the monitoring charges after the initial term or at any time in the event if government increases prices, taxes or surcharges.
                        </p>

                        <p><strong><u>5. Customer Obligations</u></strong></p>
                        <p style="margin-bottom: 15px;">
                            1) Customer agrees not to use the Services or Devices for any unlawful or abusive purpose or in any way that interferes with service provider or the equipment. Customer will comply with all laws while using the Services or equipment and will not transmit any communication that would violate any federal, state, or local law, court, or regulation.<br>
                            2) Resale of the Services or Devices is prohibited. By using the Services and/ or the Devices.<br>
                            3) Customer may not program or alter any of the Devices other than the normal programmable parameters of the Device. If any Device is stolen or Services used fraudulently, Customer must notify service provider immediately and present all such information and documentation as service provider may request (including, without limitation, police reports, and affidavits). Service Provider has the right to interrupt Services or restrict service to any Device, without notice to the Customer, if Customer is using the device in a fraudulent or unlawful manner or not paying monitoring charges.<br>
                            4) The customer shall not use or alter the equipment in any manner that could damage it or cause it to malfunctioning.<br>
                            5) The customer shall always report to the service provider if he think the equipment is mal-functioning.<br>
                            6) The customer shall always inform service provider in writing in case of any change in customer's particulars or change in customers contact detail.<br>
                            7) The Customer has to notify service provider in case he is going out of city.<br>
                            8) The customer has to notify ESSPL if the customer becomes aware of any deterioration loss or damage to the equipment.<br>
                            9) The customer understands and accepts that the malfunctioning of the equipment or any essential services provided by a carrier may cause interruption to any impairment to the service.<br>
                            10) In the event the equipment is destroyed or damaged beyond repair while in use by the customer, the customer will reimburse the service provider, the cost of such new equipment.
                        </p>

                        <p><strong><u>6. Service Warranty</u></strong></p>
                        <p style="margin-bottom: 15px;">
                            A. The equipment will be replaced or repaired by service provider during normal working hours at no cost to the customer during the agreement term commencing from the commencement date but this obligation shall exclude:<br>
                            I. Damage to the equipment caused by or arising from accidents, acts of God, unauthorized alteration and/or repairs, sabotage, misuse, tampering of abuse.<br>
                            II. Damage to the equipment caused by any person other than a person authorized by service provider.<br>
                            III. Damage to the equipment caused by power surges, lighting or blown fuses.<br>
                            IV. Damage arising from the failure of the customer to strictly comply with all operating instruction provided by service provider at the time of installation or at any other on later dates.<br>
                            V. The replacement of consumables.<br><br>
                            B. In the event the customer calls service provider for services under the warranty and the service provider responding to such call determines upon inspection that occurrence of any one or more of the exceptions list in clause 6(1) has led to the inoperability or apparent inoperability of the equipment, service provider reserves the right to charge the customer charges for such services call.<br>
                            C. Where the service provider and / or its representative is sent to the customer premises in response to the customer's call for services under this warranty, the customer agrees to pay for the transportation charges at the prevailing rate any additional work required by the customer will be changed by Service provider.
                        </p>

                        <p><strong><u>7. Termination</u></strong></p>
                        <p style="margin-bottom: 15px;">
                            A. Either party may terminate this agreement by giving not less than three (3) months written notice to the other. Any other verbal confirmations or requests shall not be accepted by service provider.<br><br>
                            B. At the time of termination of services customer will allow service provider to remove installed equipment from customers vehicle. No claim of refund shall be made to customer in case of removal of system as the equipment shall always be the property of ESS Track, however, the customer can reinstall the same equipment within 18 months in any of his vehicle, in all such cases the reinstallation reconnection and transfer charges shall be charged. After 18 months no claims of equipment shall be entertained by ESS Track.<br><br>
                            There shall be no termination damages claimable from service provider by the customer.
                        </p>

                        <div style="text-align: center; margin-bottom: 30px; margin-top: 50px;">
                            <span style="font-size: 14px; font-weight: 700;">2</span>
                        </div>

                        <p style="margin-bottom: 15px;">This agreement may be terminated by the Service provider with immediate effect if:<br>
                            a) The customer fails to follow the operating instruction provided by the Service Provider resulting in an undue number of false alarms or fails.<br>
                            b) If the vehicle in which the system is installed is so modified and altered after installation as to render continuation of services impractical.<br>
                            c) The customer defaults payment due herein.
                        </p>

                        <p><strong><u>8. Title</u></strong></p>
                        <p style="margin-bottom: 15px;">Title to service provider's equipment shall always remain with Service provider during the entire term and afterward. Upon the expiry of or earlier termination of this agreement, the possession of the equipment installed at the customer's vehicle shall be handed over to the service provider in good working condition.</p>

                        <p><strong><u>9. Notation Assignment and Sub contracting</u></strong></p>
                        <p style="margin-bottom: 15px;">
                            1) The customer agrees that the rights and obligations of Service provider under this agreement may be notate in favor of anyone authorized by Service Provider and agrees that notice in writing of such notation from Service provider is sufficient notice of that notation.<br>
                            2) The right and benefits of the customer under this agreement may not be assigned with out prior written consent of the service provider.<br>
                            3) Any Merger, acquisition, partnership, change of ownership of service provider shall not effect this agreement.
                        </p>

                        <p><strong><u>10. Service Schedule</u></strong></p>
                        <p style="margin-bottom: 15px;">The "Service Provider" provides vehicle location and tracking with the help GPS device installed in customer's Vehicle which sends the signal to central Database server of service provider through GPRS/Internet utilizing associated software.<br>
                            Account Information - It is Customers responsibility to maintain current and accurate account information on the Vehicle Tracking Direct system and to exercise diligence in protecting Customers login and passwords.<br>
                            Service provider agrees to provide and install the equipment in customer's vehicle and provide the service to the customer throughout the agreement.
                        </p>

                        <p style="margin-bottom: 5px;"><strong>SERVICE DEFINITION</strong></p>
                        <p style="margin-bottom: 15px;">
                            "Geo Fencing" means imaginary boundary of a city<br>
                            "Cut off engine" means to shut down the vehicle<br>
                            "CMS" means central monitoring station where the equipment sends a signal<br>
                            "GPS" means global positioning system commonly known as global positioning satellite<br>
                            "Track" means signals received from satellite<br>
                            "Priority Contacts" means the contact first listed in the contact details for the confirmation of any<br>
                            Signal<br>
                            "Data" means database of previous and latest tracks
                        </p>

                        <p><strong><u>11. Other Matters</u></strong></p>
                        <p style="margin-bottom: 15px;">
                            1) If any term of provisions of this agreement shall be held to be deemed or to form part of this agreement with the validity and enforceability of the remainder of the agreement of this shall not be effected.<br>
                            2) Any provision of this agreement which held invalid or unenforceable in any jurisdiction shall be ineffective to the extent of such invalidity or unenforceability without invalidating or rendering unenforceable in any other jurisdiction.<br>
                            3) Any notice to be given to either parties under terms and condition of this agreement shall be given in writing by personal delivery, registered mail or by courier services, facsimile or email addressed to the other party to be notified as the first above specified for such party.
                        </p>

                        <p style="margin-bottom: 15px;">4) Any party may change its addressed at any time appropriate notice to other party.<br>
                            5) The notice shall be deemed to have been received with actually received by the recipient against verifiable proof.
                        </p>

                        <p><strong><u>12. Limitation of Liability</u></strong></p>
                        <p style="margin-bottom: 15px;">
                            The customer acknowledges and confirms that service provider is not an insurer and that insurance if any, shall be obtained by the customer and that the amounts payable to the hereunder are pays upon the value of the services and scope of liability as herein set forth and are unrelated to the value of customers or other's property located in the customer's vehicle.<br><br>
                            The customer agrees to look exclusively to the customer's insurer to recover for injuries or damages in the event of any loss or injury or releases and waives all right of recovery against service provider arising by way of sub-rogation. Service provider make no guarantee or warranty, including any implied warranty of merchantability of fitness, that the system or services supplies will avert or prevent occurrences or the consequences therefore its impractical and results from failure on the part of service provider to perform occurrence or consequences there from which the service of system is designed to detect or avert.<br><br>
                            The customer acknowledges that it does not desire this agreement to provide for full liability of service provider and irrevocably and unconditionally Agrees not to hold the service provider liability for any loss damage injury due directly or indirectly to occurrence or consequences there from which the service of system is designed to detect or avert.<br><br>
                            No suit or legal actions or proceedings shall be brought against service provider more than 30 days after the accrual of the cause of action thereof.<br><br>
                            In the event any person not a party of this agreement shall make any claim of suit any legal proceeding action against service provider in any way relating to the equipment or services that for the subject of this agreement including for failure of its equipment or services in any respect customer agrees to indemnify service provider harmless from any expenses costs and attorney fees.
                        </p>

                        <p><strong><u>13. Governing Law and Jurisdiction</u></strong></p>
                        <p style="margin-bottom: 15px;">This agreement shall be governed and construed in accordance with the laws of Pakistan the parties here to hereby irrevocably submit to the exclusive jurisdiction of the courts of Pakistan with respect to any legal actions or proceedings in relation to this agreement.</p>

                        <p><strong><u>14. Agreement</u></strong></p>
                        <p style="margin-bottom: 15px;">This agreement supersedes and cancels any and all previous agreements and verbal commitment between the parties. The company has the right to amend, change any clause of this agreement any time without prior notice to the customer.</p>

                        <p><strong><u>15. Amendments</u></strong></p>
                        <p style="margin-bottom: 15px;">This agreement cannot be changed or amended in any way except by written document which states that a change of amendment is been made which is signed by both the parties in the absence of such documents the change or amendments shall not be enforceable.</p>

                        <p><strong><u>16. Confidential</u></strong></p>
                        <p style="margin-bottom: 15px;">Parties hereby agree to maintain complete confidential of each other's business. The obligation shall survive the expiry or termination of the agreement.</p>

                        <p style="margin-bottom: 30px;">17. It has been cleared to the customer by ESS Track that it is not an insurance agreement.</p>

                        <p style="text-align: center; font-weight: 700; margin-bottom: 40px;">In witness thereof parties have signed the agreement as of the date stated here in above</p>

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 50px; margin-top: 20px;">
                            <div>
                                <p>Company official Signature: ___________________</p>
                                <p style="margin-top: 15px;">Company official name: ___________________</p>
                                <p style="margin-top: 15px;">DATE: ___________________</p>
                                <p style="margin-top: 15px;">WITNESS NAME AND SIGN: ___________________</p>
                            </div>
                            <div>
                                <p>Customer Signature: ___________________</p>
                                <p style="margin-top: 15px;">Customer Name: ___________________</p>
                                <p style="margin-top: 30px;"></p> <!-- Spacer -->
                                <p style="margin-top: 15px;">WITNESS NAME AND SIGN: ___________________</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ACKNOWLEDGMENT SECTION -->
                <div style="background: #f8fafc; padding: 25px; border-top: 1px solid #e2e8f0;">
                    <label style="display: flex; align-items: flex-start; gap: 12px; cursor: pointer;">
                        <input type="checkbox" id="agreeCheck" required style="width: 20px; height: 20px; margin-top: 2px;">
                        <span style="font-size: 13px; color: #475569; line-height: 1.5;">
                            I have read and agree to the <a href="javascript:void(0)" onclick="openSLA()" style="color: var(--or); font-weight: 700; text-decoration: underline;">Terms & Conditions / Service Level Agreement (SLA)</a>. I confirm that all information provided is accurate and I authorize ESS-Track to proceed with the service.
                        </span>
                    </label>
                </div>

                <div id="ackSection" style="border: 2px solid #ddd; padding: 15px; border-radius: 10px; margin-bottom: 30px; transition: all 0.3s;">
                    <h4 style="font-size: 13px; margin-bottom: 10px;">Customer Acknowledgment <span style="color:#ff3b30">*</span></h4>
                    <p style="font-size: 12px; color: var(--gy);"><input type="checkbox" name="acknowledgment" required id="ackCheckbox"> I have read, understood, and hereby accept the <strong>Terms & Conditions of Service</strong> mentioned above.</p>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px; font-size: 12px;">
                    <div>
                        <p>Customer Name: <input type="text" style="border:none; border-bottom: 1px solid #000; width: 100%;"></p>
                        <p style="margin-top: 10px;">Date: {{ date('d-m-Y') }}</p>
                    </div>
                    <div style="text-align: right;">
                        <p>Customer Signature: ___________________</p>
                        <p style="margin-top: 10px;">Official Stamp: ___________________</p>
                    </div>
                </div>

                <div style="margin-top: 40px; text-align: center;">
                    <button type="button" onclick="submitAgreement(event)" class="bo" style="width: 100%; max-width: 400px; justify-content: center; font-size: 16px; padding: 18px; background: #000;">Sign & Place Order via WhatsApp <i class="fab fa-whatsapp"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- FULL SLA OVERLAY -->
<div id="slaOverlay">
    <button class="close-sla" onclick="closeSLA()">CLOSE AGREEMENT</button>
    <div class="sla-document">
        <div style="text-align: center; margin-bottom: 30px;">
            <span style="font-size: 14px; font-weight: 700;">1</span><br><br>
            <h3 style="text-decoration: underline; margin-bottom: 10px; font-size: 22px; text-transform: uppercase;">SERVICE LEVEL AGREEMENT</h3>
        </div>
        
        <p style="margin-bottom: 25px;">This Agreement is made between ESS TRACK (hereinafter referred to as the "service provider") and the user of the Tracking Service (hereinafter referred to as the "Customer"), which expression shall, where the context so permits, be deemed to include its successors and permitted assigns).</p>

        <p><strong><u>1. Definitions</u></strong></p>
        <p style="margin-bottom: 15px;">
            "Agreement" means these terms and conditions.<br>
            "Service provider" means ESS TRACK, company providing GPS tracking solutions.<br>
            "Equipment" means GPS tracking device including each and every item of equipment described in the Monitoring Service Agreement as well as each or any replacement or substitute thereof all parts and components.<br>
            "Carrier" means each and every related service provider/ law enforcement agencies, which provide essential services to enable "Service provider" to provide the services to the "customer".<br>
            "Customer" means the person hired the services or the name on which Service Agreement is made and shall include the customer's authorized representative/s.<br>
            "Commencement date" means the data on which the installation and the commissioning of the equipment on the premises had been completed.<br>
            "Customer's Equipment" means the equipment and any other equipment owned by the customer listed in the Monitoring Service Agreement.<br>
            "Service Warranty" means the warranty in clause 6.<br>
            "Technician" mean person installing or visiting customer to resolve complains.<br>
            "Initial Term" means the period of specified in service contract commencing from the date of uplink.<br>
            "Installation Price" means the price specified in the Monitoring Service Agreement.<br>
            "Monitoring Fee" means the fees specified or referred to in the Monitoring Service Agreement.<br>
            "Vehicle" means the vehicle in which the equipment has to be installed.<br>
            "Anti jammer" a device that shut downs the vehicle's engine if any Jamming device gets operational inside car; however, there is no 100% guarantee of its operations, neither 100% security of the vehicle Indemnity is claimed by ESS TRACK or its affiliates.
        </p>

        <p><strong><u>2. Installation</u></strong></p>
        <p style="margin-bottom: 15px;">
            1) "Service Provider" shall only install the equipment as per Monitoring Service Agreement and the installation shall be carried out during standard working hours, unless otherwise mutually agreed.<br>
            2) For the purpose of installation, the customer shall provide complete access to his vehicle.<br>
            3) Where the installation require additional unanticipated or unforeseen works beyond what was originally contemplated by Service Provider at the time of execution of the agreement, Service provider reserves the right to impose such other additional charges for such work.<br>
            4) The service provider is not responsible of any impairment of vehicle at the time of installation.
        </p>

        <p><strong><u>3. Payment</u></strong></p>
        <p style="margin-bottom: 15px;">
            a) The customer shall pay service provider the amount shown in the Monitoring Service Agreement for installation, before the commencement date.<br>
            b) The customer shall pay service provider throughout the agreement term, the monitoring fee in advance on quarter yearly or yearly basis.<br>
            c) In Case of delay of monitoring charges the services would be temporary suspended after a prior notice.<br>
            d) The customer shall pay all charges and fees charged by any carrier, which are properly payable in connection with the provision of service and shall keep service provider indemnified in this regard.<br>
            e) Deposits for equipment will be return to customer once the service is terminated as per clause 7.<br>
            f) Any duties and governing taxes shall be paid by the customer.<br>
            g) Service provider shall charge a reasonable reconnection/ transfer of equipment charges.
        </p>

        <p><strong><u>4. Extension of Agreement Term</u></strong></p>
        <p style="margin-bottom: 15px;">
            1) Upon expiration of the initial term, if not informed through written notice by the customer to service provider for the termination, a 15 day notice will be served to customer for the disconnection of services prior to the disconnection and if there is no reply from customer then the agreement term shall be treated over and services will be disconnected, however, if the customer is out of reach then further grace period will be granted accordingly.<br>
            2) Service provider has the right to increase the monitoring charges after the initial term or at any time in the event if government increases prices, taxes or surcharges.
        </p>

        <p><strong><u>5. Customer Obligations</u></strong></p>
        <p style="margin-bottom: 15px;">
            1) Customer agrees not to use the Services or Devices for any unlawful or abusive purpose or in any way that interferes with service provider or the equipment. Customer will comply with all laws while using the Services or equipment and will not transmit any communication that would violate any federal, state, or local law, court, or regulation.<br>
            2) Resale of the Services or Devices is prohibited. By using the Services and/ or the Devices.<br>
            3) Customer may not program or alter any of the Devices other than the normal programmable parameters of the Device. If any Device is stolen or Services used fraudulently, Customer must notify service provider immediately and present all such information and documentation as service provider may request (including, without limitation, police reports, and affidavits). Service Provider has the right to interrupt Services or restrict service to any Device, without notice to the Customer, if Customer is using the device in a fraudulent or unlawful manner or not paying monitoring charges.<br>
            4) The customer shall not use or alter the equipment in any manner that could damage it or cause it to malfunctioning.<br>
            5) The customer shall always report to the service provider if he think the equipment is mal-functioning.<br>
            6) The customer shall always inform service provider in writing in case of any change in customer's particulars or change in customers contact detail.<br>
            7) The Customer has to notify service provider in case he is going out of city.<br>
            8) The customer has to notify ESSPL if the customer becomes aware of any deterioration loss or damage to the equipment.<br>
            9) The customer understands and accepts that the malfunctioning of the equipment or any essential services provided by a carrier may cause interruption to any impairment to the service.<br>
            10) In the event the equipment is destroyed or damaged beyond repair while in use by the customer, the customer will reimburse the service provider, the cost of such new equipment.
        </p>

        <p><strong><u>6. Service Warranty</u></strong></p>
        <p style="margin-bottom: 15px;">
            A. The equipment will be replaced or repaired by service provider during normal working hours at no cost to the customer during the agreement term commencing from the commencement date but this obligation shall exclude:<br>
            I. Damage to the equipment caused by or arising from accidents, acts of God, unauthorized alteration and/or repairs, sabotage, misuse, tampering of abuse.<br>
            II. Damage to the equipment caused by any person other than a person authorized by service provider.<br>
            III. Damage to the equipment caused by power surges, lighting or blown fuses.<br>
            IV. Damage arising from the failure of the customer to strictly comply with all operating instruction provided by service provider at the time of installation or at any other on later dates.<br>
            V. The replacement of consumables.<br><br>
            B. In the event the customer calls service provider for services under the warranty and the service provider responding to such call determines upon inspection that occurrence of any one or more of the exceptions list in clause 6(1) has led to the inoperability or apparent inoperability of the equipment, service provider reserves the right to charge the customer charges for such services call.<br>
            C. Where the service provider and / or its representative is sent to the customer premises in response to the customer's call for services under this warranty, the customer agrees to pay for the transportation charges at the prevailing rate any additional work required by the customer will be changed by Service provider.
        </p>

        <p><strong><u>7. Termination</u></strong></p>
        <p style="margin-bottom: 15px;">
            A. Either party may terminate this agreement by giving not less than three (3) months written notice to the other. Any other verbal confirmations or requests shall not be accepted by service provider.<br><br>
            B. At the time of termination of services customer will allow service provider to remove installed equipment from customers vehicle. No claim of refund shall be made to customer in case of removal of system as the equipment shall always be the property of ESS Track, however, the customer can reinstall the same equipment within 18 months in any of his vehicle, in all such cases the reinstallation reconnection and transfer charges shall be charged. After 18 months no claims of equipment shall be entertained by ESS Track.<br><br>
            There shall be no termination damages claimable from service provider by the customer.
        </p>

        <div style="text-align: center; margin-bottom: 30px; margin-top: 50px;">
            <span style="font-size: 14px; font-weight: 700;">2</span>
        </div>

        <p style="margin-bottom: 15px;">This agreement may be terminated by the Service provider with immediate effect if:<br>
            a) The customer fails to follow the operating instruction provided by the Service Provider resulting in an undue number of false alarms or fails.<br>
            b) If the vehicle in which the system is installed is so modified and altered after installation as to render continuation of services impractical.<br>
            c) The customer defaults payment due herein.
        </p>

        <p><strong><u>8. Title</u></strong></p>
        <p style="margin-bottom: 15px;">Title to service provider's equipment shall always remain with Service provider during the entire term and afterward. Upon the expiry of or earlier termination of this agreement, the possession of the equipment installed at the customer's vehicle shall be handed over to the service provider in good working condition.</p>

        <p><strong><u>9. Notation Assignment and Sub contracting</u></strong></p>
        <p style="margin-bottom: 15px;">
            1) The customer agrees that the rights and obligations of Service provider under this agreement may be notate in favor of anyone authorized by Service Provider and agrees that notice in writing of such notation from Service provider is sufficient notice of that notation.<br>
            2) The right and benefits of the customer under this agreement may not be assigned with out prior written consent of the service provider.<br>
            3) Any Merger, acquisition, partnership, change of ownership of service provider shall not effect this agreement.
        </p>

        <p><strong><u>10. Service Schedule</u></strong></p>
        <p style="margin-bottom: 15px;">The "Service Provider" provides vehicle location and tracking with the help GPS device installed in customer's Vehicle which sends the signal to central Database server of service provider through GPRS/Internet utilizing associated software.<br>
            Account Information - It is Customers responsibility to maintain current and accurate account information on the Vehicle Tracking Direct system and to exercise diligence in protecting Customers login and passwords.<br>
            Service provider agrees to provide and install the equipment in customer's vehicle and provide the service to the customer throughout the agreement.
        </p>

        <p style="margin-bottom: 5px;"><strong>SERVICE DEFINITION</strong></p>
        <p style="margin-bottom: 15px;">
            "Geo Fencing" means imaginary boundary of a city<br>
            "Cut off engine" means to shut down the vehicle<br>
            "CMS" means central monitoring station where the equipment sends a signal<br>
            "GPS" means global positioning system commonly known as global positioning satellite<br>
            "Track" means signals received from satellite<br>
            "Priority Contacts" means the contact first listed in the contact details for the confirmation of any<br>
            Signal<br>
            "Data" means database of previous and latest tracks
        </p>

        <p><strong><u>11. Other Matters</u></strong></p>
        <p style="margin-bottom: 15px;">
            1) If any term of provisions of this agreement shall be held to be deemed or to form part of this agreement with the validity and enforceability of the remainder of the agreement of this shall not be effected.<br>
            2) Any provision of this agreement which held invalid or unenforceable in any jurisdiction shall be ineffective to the extent of such invalidity or unenforceability without invalidating or rendering unenforceable in any other jurisdiction.<br>
            3) Any notice to be given to either parties under terms and condition of this agreement shall be given in writing by personal delivery, registered mail or by courier services, facsimile or email addressed to the other party to be notified as the first above specified for such party.
        </p>

        <p style="margin-bottom: 15px;">4) Any party may change its addressed at any time appropriate notice to other party.<br>
            5) The notice shall be deemed to have been received with actually received by the recipient against verifiable proof.
        </p>

        <p><strong><u>12. Limitation of Liability</u></strong></p>
        <p style="margin-bottom: 15px;">
            The customer acknowledges and confirms that service provider is not an insurer and that insurance if any, shall be obtained by the customer and that the amounts payable to the hereunder are pays upon the value of the services and scope of liability as herein set forth and are unrelated to the value of customers or other's property located in the customer's vehicle.<br><br>
            The customer agrees to look exclusively to the customer's insurer to recover for injuries or damages in the event of any loss or injury or releases and waives all right of recovery against service provider arising by way of sub-rogation. Service provider make no guarantee or warranty, including any implied warranty of merchantability of fitness, that the system or services supplies will avert or prevent occurrences or the consequences therefore its impractical and results from failure on the part of service provider to perform occurrence or consequences there from which the service of system is designed to detect or avert.<br><br>
            The customer acknowledges that it does not desire this agreement to provide for full liability of service provider and irrevocably and unconditionally Agrees not to hold the service provider liability for any loss damage injury due directly or indirectly to occurrence or consequences there from which the service of system is designed to detect or avert.<br><br>
            No suit or legal actions or proceedings shall be brought against service provider more than 30 days after the accrual of the cause of action thereof.<br><br>
            In the event any person not a party of this agreement shall make any claim of suit any legal proceeding action against service provider in any way relating to the equipment or services that for the subject of this agreement including for failure of its equipment or services in any respect customer agrees to indemnify service provider harmless from any expenses costs and attorney fees.
        </p>

        <p><strong><u>13. Governing Law and Jurisdiction</u></strong></p>
        <p style="margin-bottom: 15px;">This agreement shall be governed and construed in accordance with the laws of Pakistan the parties here to hereby irrevocably submit to the exclusive jurisdiction of the courts of Pakistan with respect to any legal actions or proceedings in relation to this agreement.</p>

        <p><strong><u>14. Agreement</u></strong></p>
        <p style="margin-bottom: 15px;">This agreement supersedes and cancels any and all previous agreements and verbal commitment between the parties. The company has the right to amend, change any clause of this agreement any time without prior notice to the customer.</p>

        <p><strong><u>15. Amendments</u></strong></p>
        <p style="margin-bottom: 15px;">This agreement cannot be changed or amended in any way except by written document which states that a change of amendment is been made which is signed by both the parties in the absence of such documents the change or amendments shall not be enforceable.</p>

        <p><strong><u>16. Confidential</u></strong></p>
        <p style="margin-bottom: 15px;">Parties hereby agree to maintain complete confidential of each other's business. The obligation shall survive the expiry or termination of the agreement.</p>

        <p style="margin-bottom: 30px;">17. It has been cleared to the customer by ESS Track that it is not an insurance agreement.</p>

        <p style="text-align: center; font-weight: 700; margin-bottom: 40px;">In witness thereof parties have signed the agreement as of the date stated here in above</p>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 50px; margin-top: 20px;">
            <div>
                <p>Company official Signature: ___________________</p>
                <p style="margin-top: 15px;">Company official name: ___________________</p>
                <p style="margin-top: 15px;">DATE: ___________________</p>
                <p style="margin-top: 15px;">WITNESS NAME AND SIGN: ___________________</p>
            </div>
            <div>
                <p>Customer Signature: ___________________</p>
                <p style="margin-top: 15px;">Customer Name: ___________________</p>
                <p style="margin-top: 30px;"></p> <!-- Spacer -->
                <p style="margin-top: 15px;">WITNESS NAME AND SIGN: ___________________</p>
            </div>
        </div>
    </div>
</div>

<a href="https://wa.me/923342011104?text=Hey%2C%20can%20I%20get%20more%20info%20about%20packages%3F" class="wa-float" target="_blank" title="Chat with us on WhatsApp">
    <i class="fab fa-whatsapp"></i>
    <span class="wa-badge">1</span>
</a>

<button id="scrollTopBtn" title="Go to top"><i class="fas fa-arrow-up"></i></button>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    // Initialize AOS
    AOS.init({
        duration: 800,
        once: true,
        easing: 'ease-in-out'
    });

    // Mobile Menu Toggle
    function toggleMobileMenu() {
        const menu = document.getElementById('mobMenu');
        menu.classList.toggle('open');
    }

    // Mega Promo Modal Logic
    function openPromo() {
        document.getElementById('megaPromo').style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }

    function closePromo() {
        document.getElementById('megaPromo').style.display = 'none';
        document.body.style.overflow = 'auto';
    }

    function showPromoPackages(type) {
        const rentalGrid = document.getElementById('promoRentalGrid');
        const deviceGrid = document.getElementById('promoDeviceGrid');
        const rentalBtn = document.getElementById('promoRentalBtn');
        const deviceBtn = document.getElementById('promoDeviceBtn');
        if (!rentalGrid) return;
        if (type === 'rental') {
            rentalGrid.style.display = 'block';
            deviceGrid.style.display = 'none';
            rentalBtn.classList.add('active');
            deviceBtn.classList.remove('active');
        } else {
            rentalGrid.style.display = 'none';
            deviceGrid.style.display = 'block';
            rentalBtn.classList.remove('active');
            deviceBtn.classList.add('active');
        }
    }

    // Keep old function for compatibility (services page may use it)
    function showModalPackages(type) { showPromoPackages(type); }

    // Booking Modal Logic
    function openBookingModal(pkgName) {
        document.getElementById('selectedPkgField').value = pkgName;
        document.getElementById('bookingModal').style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }

    function closeBookingModal() {
        document.getElementById('bookingModal').style.display = 'none';
        document.body.style.overflow = 'auto';
        resetOTPUI();
        document.getElementById('agreementForm').reset();
    }

    function openSLA() {
        document.getElementById('slaOverlay').style.display = 'block';
        document.body.style.overflow = 'hidden';
    }

    function closeSLA() {
        document.getElementById('slaOverlay').style.display = 'none';
        if(document.getElementById('bookingModal').style.display !== 'flex') {
            document.body.style.overflow = 'auto';
        }
    }

    // --- STRICT VALIDATION LOGIC ---
    function showValidationTip(input, msg) {
        input.classList.add('input-error-shake');
        setTimeout(() => input.classList.remove('input-error-shake'), 1000);
        const tip = document.createElement('div');
        tip.className = 'validation-tip';
        tip.innerText = msg;
        const rect = input.getBoundingClientRect();
        tip.style.left = (rect.left + window.scrollX) + 'px';
        tip.style.top = (rect.top + window.scrollY - 30) + 'px';
        document.body.appendChild(tip);
        setTimeout(() => tip.remove(), 1500);
    }

    function allowOnlyAlphabets(e) {
        const charCode = (e.which) ? e.which : e.keyCode;
        if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123) || charCode == 32) {
            return true;
        }
        showValidationTip(e.target, "Alphabet use karein! Please fill requirements properly.");
        e.preventDefault();
        return false;
    }

    function allowOnlyNumbers(e) {
        const charCode = (e.which) ? e.which : e.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            showValidationTip(e.target, "Sirf Numbers use karein! Please fill requirements properly.");
            e.preventDefault();
            return false;
        }
        return true;
    }

    // --- OTP LOGIC ---
    let isOtpVerified = false;
    const backendUrl = "{{ env('VITE_BACKEND_API_URL') }}" || "/api";

    function showOTPOptions() {
        const mobile = document.getElementById('custMobile').value;
        if (!mobile || mobile.length < 10) {
            alert("Please fill the requirements properly! Mobile number enter karein.");
            document.getElementById('custMobile').focus();
            return;
        }
        document.getElementById('otpWrapper').style.display = 'block';
    }

    async function sendOTP(method) {
        const mobile = document.getElementById('custMobile').value;
        const btn = method === 'SIM' ? document.getElementById('btnSms') : document.getElementById('btnWa');
        try {
            btn.innerHTML = 'Sending...';
            const response = await fetch(`${backendUrl}/send-otp`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ phone: mobile, method: method })
            });
            const data = await response.json();
            if (data.status === 'success') {
                btn.innerHTML = 'Sent';
                document.getElementById('otpInputGroup').style.display = 'block';
                startTimer();
            } else { alert(data.message); btn.innerHTML = 'Retry'; }
        } catch (error) { alert("Backend error!"); }
    }

    function startTimer() {
        let sec = 30;
        const timer = document.getElementById('timerSec');
        const interval = setInterval(() => {
            sec--;
            timer.innerText = sec;
            if (sec <= 0) { clearInterval(interval); }
        }, 1000);
    }

    async function verifyOTP() {
        const mobile = document.getElementById('custMobile').value;
        const code = document.getElementById('otpInput').value;
        const response = await fetch(`${backendUrl}/verify-otp`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ phone: mobile, otp: code })
        });
        const data = await response.json();
        if (data.status === 'success') {
            isOtpVerified = true;
            document.getElementById('otpInputGroup').style.display = 'none';
            document.getElementById('otpSuccess').style.display = 'block';
        } else { alert("Invalid OTP!"); }
    }

    function resetOTPUI() {
        isOtpVerified = false;
        document.getElementById('otpWrapper').style.display = 'none';
        document.getElementById('otpInputGroup').style.display = 'none';
        document.getElementById('otpSuccess').style.display = 'none';
    }

    async function submitAgreement(e) {
        if (!isOtpVerified) { alert("Please fill the requirements properly! Verify OTP first."); return; }
        const form = document.getElementById('agreementForm');
        if (!form.checkValidity()) { alert("Please fill the requirements properly!"); form.reportValidity(); return; }
        
        const btn = e.target.closest('button');
        btn.innerHTML = 'Processing...';
        const formData = new FormData(form);
        const data = {}; formData.forEach((v,k) => data[k] = v);

        try {
            const resp = await fetch(`${backendUrl}/inquiries`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(data)
            });
            const res = await resp.json();
            if (res.status === 'success') {
                window.open('https://wa.me/923342011104?text=New%20Service%20Agreement', '_blank');
                closeBookingModal();
            }
        } catch (err) { alert("Error!"); btn.innerHTML = 'Sign & Order'; }
    }

    window.onscroll = function() {
        const nav = document.getElementById('mainNav');
        const btn = document.getElementById('scrollTopBtn');
        if (window.pageYOffset > 50) { nav.style.top = '0'; } else { nav.style.top = '37px'; }
        btn.style.display = window.pageYOffset > 200 ? 'block' : 'none';
    };

    // Auto-open on Home page — 2 seconds after page is ready
    @if(request()->routeIs('home'))
    setTimeout(function() {
        var promo = document.getElementById('megaPromo');
        if (promo) { openPromo(); }
    }, 2000);
    @endif
</script>
</body>
</html>
