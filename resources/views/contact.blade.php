@extends('layouts.app')

@section('title', 'Contact Us — ESS-TRACK BY ESSPL')

@section('content')
<!-- INNER HERO -->
<section style="background: var(--nv); padding: 160px 0 100px; color: #fff; position: relative; overflow: hidden;">
    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0.1; background-image: url('https://www.transparenttextures.com/patterns/carbon-fibre.png');"></div>
    <div class="wrap" style="position: relative; z-index: 2; text-align: center;">
        <div class="lbl c" style="color: var(--or);">Get In Touch</div>
        <h2 class="ttl" style="color: #fff; margin-bottom: 20px;">We Are <span style="color: var(--or);">Here To Help</span></h2>
        <p class="dsc" style="color: rgba(255,255,255,0.7); max-width: 700px; margin: 0 auto;">Have questions about our tracking systems or need technical support? Reach out to our expert team anytime.</p>
    </div>
</section>

<!-- CONTACT SECTION -->
<section style="background: #fff; padding-bottom: 120px;">
    <div class="wrap">
        <div style="display: flex; gap: 60px; margin-top: -60px; flex-wrap: wrap;">
            
            <!-- Contact Info -->
            <div style="flex: 0.8; min-width: 300px;" data-aos="fade-right">
                <div style="background: var(--nv); color: #fff; padding: 50px; border-radius: 30px; height: 100%; box-shadow: 0 30px 60px rgba(13, 27, 42, 0.2);">
                    <h3 style="font-size: 24px; margin-bottom: 30px;">Contact Information</h3>
                    
                    <div style="margin-bottom: 35px; display: flex; align-items: flex-start; gap: 20px;">
                        <div style="width: 45px; height: 45px; background: rgba(255,255,255,0.05); color: var(--or); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 18px; border: 1px solid rgba(255,255,255,0.1); flex-shrink: 0;"><i class="fas fa-map-marker-alt"></i></div>
                        <div>
                            <div style="font-size: 13px; color: rgba(255,255,255,0.5); font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 5px;">Our Office</div>
                            <div style="font-size: 15px; line-height: 1.6;">Suit 201, Kawish Crown, Block 6 PECHS, Karachi, Pakistan.</div>
                        </div>
                    </div>
                    
                    <div style="margin-bottom: 35px; display: flex; align-items: flex-start; gap: 20px;">
                        <div style="width: 45px; height: 45px; background: rgba(255,255,255,0.05); color: var(--or); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 18px; border: 1px solid rgba(255,255,255,0.1); flex-shrink: 0;"><i class="fas fa-phone-alt"></i></div>
                        <div>
                            <div style="font-size: 13px; color: rgba(255,255,255,0.5); font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 5px;">Phone Number</div>
                            <div style="font-size: 15px;">021-34330887-88</div>
                        </div>
                    </div>
                    
                    <div style="margin-bottom: 45px; display: flex; align-items: flex-start; gap: 20px;">
                        <div style="width: 45px; height: 45px; background: rgba(255,255,255,0.05); color: var(--or); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 18px; border: 1px solid rgba(255,255,255,0.1); flex-shrink: 0;"><i class="fas fa-envelope"></i></div>
                        <div>
                            <div style="font-size: 13px; color: rgba(255,255,255,0.5); font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 5px;">Email Address</div>
                            <div style="font-size: 15px;">info@esspl.com.pk</div>
                        </div>
                    </div>
                    
                    <div style="border-top: 1px solid rgba(255,255,255,0.1); padding-top: 30px;">
                        <div style="font-size: 13px; color: rgba(255,255,255,0.5); font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 20px;">Follow Us</div>
                        <div style="display: flex; gap: 12px;">
                            <a href="https://www.facebook.com/ESSTRACKPAKISTAN" target="_blank" class="soc"><i class="fab fa-facebook-f"></i></a>
                            <a href="https://wa.me/923342011104?text=Hey%2C%20can%20I%20get%20more%20info%20about%20packages%3F" target="_blank" class="soc"><i class="fab fa-whatsapp"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Contact Form -->
            <div style="flex: 1.2; min-width: 300px;" data-aos="fade-left">
                <div style="background: #fff; padding: 50px; border-radius: 30px; box-shadow: 0 40px 100px rgba(0,0,0,0.08); border: 1px solid rgba(0,0,0,0.05);">
                    <h3 style="font-size: 24px; color: var(--nv); margin-bottom: 10px;">Send Us a Message</h3>
                    <p style="font-size: 14px; color: var(--gy); margin-bottom: 35px;">Fill out the form and our team will get back to you within 24 hours.</p>
                    
                    <form id="contactForm">
                        @csrf
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px;">
                            <div>
                                <label style="display: block; font-size: 13px; font-weight: 700; color: var(--nv); margin-bottom: 8px; text-transform: uppercase;">First Name</label>
                                <input type="text" name="first_name" placeholder="Your first name" required style="width: 100%; padding: 12px 18px; border-radius: 10px; border: 1px solid var(--lt); background: var(--of); font-family: inherit; font-size: 14px; outline: none; transition: border-color 0.2s;" onfocus="this.style.borderColor='var(--or)'" onblur="this.style.borderColor='var(--lt)'">
                            </div>
                            <div>
                                <label style="display: block; font-size: 13px; font-weight: 700; color: var(--nv); margin-bottom: 8px; text-transform: uppercase;">Last Name</label>
                                <input type="text" name="last_name" placeholder="Your last name" required style="width: 100%; padding: 12px 18px; border-radius: 10px; border: 1px solid var(--lt); background: var(--of); font-family: inherit; font-size: 14px; outline: none; transition: border-color 0.2s;" onfocus="this.style.borderColor='var(--or)'" onblur="this.style.borderColor='var(--lt)'">
                            </div>
                        </div>

                        <div style="margin-bottom: 20px;">
                            <label style="display: block; font-size: 13px; font-weight: 700; color: var(--nv); margin-bottom: 8px; text-transform: uppercase;">Email Address</label>
                            <input type="email" name="email" placeholder="your@email.com" required style="width: 100%; padding: 12px 18px; border-radius: 10px; border: 1px solid var(--lt); background: var(--of); font-family: inherit; font-size: 14px; outline: none; transition: border-color 0.2s;" onfocus="this.style.borderColor='var(--or)'" onblur="this.style.borderColor='var(--lt)'">
                        </div>

                        <div style="margin-bottom: 20px;">
                            <label style="display: block; font-size: 13px; font-weight: 700; color: var(--nv); margin-bottom: 8px; text-transform: uppercase;">Phone Number</label>
                            <div style="display: flex; gap: 10px;">
                                <input type="tel" name="phone" id="contactPhone" placeholder="e.g. 03001234567" required style="flex: 1; padding: 12px 18px; border-radius: 10px; border: 1px solid var(--lt); background: var(--of); font-family: inherit; font-size: 14px; outline: none; transition: border-color 0.2s;" onfocus="this.style.borderColor='var(--or)'" onblur="this.style.borderColor='var(--lt)'">
                                <button type="button" id="btnSendOtp" onclick="handleContactOtp()" class="bn" style="padding: 0 20px; font-size: 12px; white-space: nowrap;">Get OTP</button>
                            </div>
                        </div>

                        <!-- OTP Field (Hidden) -->
                        <div id="contactOtpWrapper" style="display: none; margin-bottom: 20px; background: #f0f4f8; padding: 20px; border-radius: 15px; border: 1px solid #cbd5e1;">
                            <label style="display: block; font-size: 12px; font-weight: 800; color: var(--nv); margin-bottom: 10px; text-transform: uppercase;">Enter 4-Digit OTP:</label>
                            <div style="display: flex; gap: 10px;">
                                <input type="text" id="contactOtpInput" maxlength="4" placeholder="____" style="flex: 1; text-align: center; letter-spacing: 10px; font-size: 20px; font-weight: 900; padding: 10px; border: 2px solid var(--nv); border-radius: 10px;">
                                <button type="button" onclick="verifyContactOtp()" class="bo" style="padding: 0 25px;">Verify</button>
                            </div>
                            <div id="contactOtpTimer" style="font-size: 11px; color: var(--gy); margin-top: 10px; text-align: right;">Resend in <span id="contactTimerSec">30</span>s</div>
                        </div>
                        <div id="contactOtpSuccess" style="display: none; margin-bottom: 20px; color: #059669; font-weight: 700; font-size: 14px; text-align: center; background: #ecfdf5; padding: 10px; border-radius: 10px; border: 1px solid #10b981;">
                            <i class="fas fa-check-circle"></i> Phone Number Verified!
                        </div>
                        
                        <div style="margin-bottom: 20px;">
                            <label style="display: block; font-size: 13px; font-weight: 700; color: var(--nv); margin-bottom: 8px; text-transform: uppercase;">Vehicle Type</label>
                            <select name="vehicle_type" style="width: 100%; padding: 12px 18px; border-radius: 10px; border: 1px solid var(--lt); background: var(--of); font-family: inherit; font-size: 14px; outline: none; cursor: pointer;">
                                <option value="" disabled selected>Select vehicle type...</option>
                                <option>Car / Sedan</option>
                                <option>Bike / Motorcycle</option>
                                <option>SUV / Pickup</option>
                                <option>Truck / Heavy Vehicle</option>
                                <option>Other</option>
                            </select>
                        </div>

                        <div style="margin-bottom: 20px;">
                            <label style="display: block; font-size: 13px; font-weight: 700; color: var(--nv); margin-bottom: 8px; text-transform: uppercase;">Interested Package</label>
                            <select name="package" style="width: 100%; padding: 12px 18px; border-radius: 10px; border: 1px solid var(--lt); background: var(--of); font-family: inherit; font-size: 14px; outline: none; cursor: pointer;">
                                <option value="" disabled selected>Select a package...</option>
                                <option>Basic Package</option>
                                <option>Silver Package</option>
                                <option>Gold Package</option>
                                <option>Diamond Package</option>
                                <option>Fleet Management</option>
                            </select>
                        </div>
                        
                        <div style="margin-bottom: 30px;">
                            <label style="display: block; font-size: 13px; font-weight: 700; color: var(--nv); margin-bottom: 8px; text-transform: uppercase;">Message</label>
                            <textarea name="message" placeholder="Tell us about your vehicle tracking requirements..." required rows="4" style="width: 100%; padding: 12px 18px; border-radius: 10px; border: 1px solid var(--lt); background: var(--of); font-family: inherit; font-size: 14px; outline: none; transition: border-color 0.2s; resize: vertical;" onfocus="this.style.borderColor='var(--or)'" onblur="this.style.borderColor='var(--lt)'"></textarea>
                        </div>
                        
                        <button type="submit" id="btnSubmitContact" class="bo" style="width: 100%; justify-content: center; padding: 15px;">Send Message <i class="fas fa-paper-plane" style="margin-left: 10px;"></i></button>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</section>

<!-- MAP SECTION -->
<section style="padding: 0; background: var(--lt);">
    <div style="height: 450px; width: 100%; background: #eee; display: flex; align-items: center; justify-content: center; position: relative;">
        <!-- Placeholder for Map -->
        <div style="text-align: center; color: var(--gy);">
            <div style="font-size: 40px; margin-bottom: 10px;"><i class="fas fa-map-marked-alt"></i></div>
            <p style="font-weight: 600;">Google Maps Integration Here</p>
            <p style="font-size: 12px;">Suit 201, Kawish Crown, Block 6 PECHS, Karachi</p>
        </div>
        <!-- Real map would go here in production -->
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3619.641604169!2d67.0664!3d24.8719!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3eb33ef3b8398b1b%3A0xa193d9282362b53b!2sKawish%20Crown!5e0!3m2!1sen!2s!4v1714000000000!5m2!1sen!2s" width="100%" height="100%" style="border:0; position: absolute; top:0; left:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>
</section>
@section('scripts')
<script>
    const contactBackendUrl = "{{ env('VITE_BACKEND_API_URL') }}";
    let isContactOtpVerified = false;

    async function handleContactOtp() {
        const phone = document.getElementById('contactPhone').value;
        if (!phone || phone.length < 10) {
            alert("Please enter a valid phone number!");
            return;
        }

        const btn = document.getElementById('btnSendOtp');
        try {
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>...';
            btn.disabled = true;

            const response = await fetch(`${contactBackendUrl}/send-otp`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ phone: phone, method: 'SIM' })
            });

            const data = await response.json();
            if (data.status === 'success') {
                document.getElementById('contactOtpWrapper').style.display = 'block';
                startContactTimer();
                alert("OTP Sent Successfully!");
            } else {
                alert(data.message || "Error sending OTP.");
                btn.innerHTML = "Get OTP";
                btn.disabled = false;
            }
        } catch (error) {
            alert("Backend connection error!");
            btn.innerHTML = "Get OTP";
            btn.disabled = false;
        }
    }

    function startContactTimer() {
        let sec = 30;
        const timer = document.getElementById('contactTimerSec');
        const interval = setInterval(() => {
            sec--;
            timer.innerText = sec;
            if (sec <= 0) {
                clearInterval(interval);
                document.getElementById('contactOtpTimer').innerHTML = '<a href="#" onclick="handleContactOtp()" style="color:var(--or); text-decoration:none;">Resend Code</a>';
            }
        }, 1000);
    }

    async function verifyContactOtp() {
        const phone = document.getElementById('contactPhone').value;
        const otp = document.getElementById('contactOtpInput').value;

        try {
            const response = await fetch(`${contactBackendUrl}/verify-otp`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ phone: phone, otp: otp })
            });

            const data = await response.json();
            if (data.status === 'success') {
                isContactOtpVerified = true;
                document.getElementById('contactOtpWrapper').style.display = 'none';
                document.getElementById('contactOtpSuccess').style.display = 'block';
                document.getElementById('contactPhone').readOnly = true;
                document.getElementById('btnSendOtp').style.display = 'none';
            } else {
                alert(data.message || "Invalid OTP!");
            }
        } catch (error) {
            alert("Verification error!");
        }
    }

    document.getElementById('contactForm').onsubmit = async (e) => {
        e.preventDefault();
        
        if (!isContactOtpVerified) {
            alert("Please verify your phone number first!");
            return;
        }

        const btn = document.getElementById('btnSubmitContact');
        const original = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';
        btn.disabled = true;

        const formData = new FormData(e.target);
        const plainData = {};
        formData.forEach((value, key) => plainData[key] = value);
        
        // Map fields to backend expectations
        plainData.vehicleType = plainData.vehicle_type;
        plainData.interested_package = plainData.package;

        try {
            const response = await fetch(`${contactBackendUrl}/inquiries`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(plainData)
            });

            const data = await response.json();
            if (data.status === 'success') {
                alert("Thank you! Your inquiry has been submitted successfully.");
                e.target.reset();
                location.reload();
            } else {
                alert(data.message || "Error submitting form.");
                btn.innerHTML = original;
                btn.disabled = false;
            }
        } catch (error) {
            alert("Submission error!");
            btn.innerHTML = original;
            btn.disabled = false;
        }
    };
</script>
@endsection
@endsection
