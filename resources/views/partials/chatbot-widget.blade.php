@if(config('chatbot.enabled'))
@php
    $chatContact = $siteContact ?? [];
    $chatPhone = $chatContact['phone'] ?? '021-34330887-88';
    $chatPhoneHref = $chatContact['phone_href'] ?? preg_replace('/[^0-9+]/', '', $chatPhone);
@endphp
<div id="essChatbot">
    <button type="button" id="essChatToggle" aria-label="Open chat" title="ESS-Track Assistant">
        <i class="fas fa-comments"></i>
    </button>
    <div id="essChatPanel" style="display:none;">
        <div class="ess-chat-head">
            <div>
                <strong>ESS-Track Assistant</strong>
                <span>English support</span>
            </div>
            <button type="button" id="essChatClose" aria-label="Close chat"><i class="fas fa-times"></i></button>
        </div>
        <div id="essChatMessages"></div>
        <div id="essLeadCard" class="ess-lead-card" style="display:none;">
            <div class="ess-lead-title">Please share your details</div>
            <input type="text" id="essLeadName" placeholder="Your name" autocomplete="name" maxlength="80">
            <input type="email" id="essLeadEmail" placeholder="Email address" autocomplete="email" maxlength="120">
            <input type="tel" id="essLeadPhone" placeholder="Contact number" autocomplete="tel" maxlength="25">
            <button type="button" id="essLeadSubmit">Continue</button>
            <p>For package details, you can also contact ESSPL at <a href="tel:{{ $chatPhoneHref }}">{{ $chatPhone }}</a>.</p>
        </div>
        <div class="ess-chat-quick" style="display:none;">
            <button type="button" data-q="What packages do you offer?">Packages</button>
            <button type="button" data-q="What is the contact number?">Contact</button>
            <button type="button" data-q="Any promo or discount code?">Promo Code</button>
        </div>
        <form id="essChatForm" style="display:none;">
            <input type="text" id="essChatInput" placeholder="Type your question..." autocomplete="off" maxlength="500">
            <button type="submit"><i class="fas fa-paper-plane"></i></button>
        </form>
    </div>
</div>
<style>
#essChatbot{position:fixed;bottom:90px;right:24px;z-index:2500;font-family:'Poppins',sans-serif;}
#essChatToggle{width:56px;height:56px;border-radius:50%;border:none;background:linear-gradient(135deg,#0d1b2a,#1b2f45);color:#fff;font-size:22px;cursor:pointer;box-shadow:0 6px 24px rgba(0,0,0,.25);}
#essChatPanel{position:absolute;bottom:70px;right:0;width:360px;max-width:calc(100vw - 32px);background:#fff;border-radius:16px;box-shadow:0 12px 40px rgba(0,0,0,.18);overflow:hidden;display:flex;flex-direction:column;max-height:560px;}
.ess-chat-head{background:linear-gradient(135deg,#0d1b2a,#1b2f45);color:#fff;padding:14px 16px;display:flex;justify-content:space-between;align-items:flex-start;}
.ess-chat-head strong{display:block;font-size:14px;}.ess-chat-head span{font-size:10px;opacity:.7;}.ess-chat-head button{background:none;border:none;color:#fff;cursor:pointer;font-size:16px;}
#essChatMessages{padding:14px;overflow-y:auto;flex:1;min-height:120px;max-height:230px;background:#f7f8fa;}
.ess-msg{margin-bottom:10px;padding:10px 12px;border-radius:12px;font-size:13px;line-height:1.55;max-width:92%;white-space:pre-wrap;}.ess-msg.bot{background:#fff;border:1px solid #e5e7eb;color:#374151;}.ess-msg.user{background:var(--or,#f47c20);color:#fff;margin-left:auto;}
.ess-lead-card{padding:12px 14px;border-top:1px solid #eee;display:grid;gap:8px;background:#fff;}.ess-lead-title{font-size:13px;font-weight:700;color:#111827;}.ess-lead-card input{border:1px solid #d1d5db;border-radius:8px;padding:10px;font-size:13px;}.ess-lead-card button{background:var(--or,#f47c20);color:#fff;border:none;border-radius:8px;padding:11px;font-size:13px;font-weight:700;cursor:pointer;}.ess-lead-card p{font-size:11.5px;line-height:1.5;color:#6b7280;margin:2px 0 0;}.ess-lead-card a{color:var(--or,#f47c20);font-weight:700;text-decoration:none;}
.ess-chat-quick{display:flex;gap:6px;padding:8px 12px;flex-wrap:wrap;border-top:1px solid #eee;}.ess-chat-quick button{font-size:10px;padding:5px 10px;border:1px solid #ddd;border-radius:20px;background:#fff;cursor:pointer;}
#essChatForm{display:flex;padding:10px;border-top:1px solid #eee;gap:8px;}#essChatInput{flex:1;border:1px solid #ddd;border-radius:8px;padding:10px;font-size:13px;}#essChatForm button{background:var(--or,#f47c20);color:#fff;border:none;border-radius:8px;padding:0 14px;cursor:pointer;}
@media(max-width:600px){#essChatbot{bottom:80px;right:16px;}}
</style>
<script>
(function(){
    const panel=document.getElementById('essChatPanel'),toggle=document.getElementById('essChatToggle'),close=document.getElementById('essChatClose'),form=document.getElementById('essChatForm'),input=document.getElementById('essChatInput'),box=document.getElementById('essChatMessages'),quick=document.querySelector('.ess-chat-quick'),leadCard=document.getElementById('essLeadCard'),leadName=document.getElementById('essLeadName'),leadEmail=document.getElementById('essLeadEmail'),leadPhone=document.getElementById('essLeadPhone'),leadSubmit=document.getElementById('essLeadSubmit');
    if(!panel)return;
    const storageKey='essTrackChatLeadEnglishFormV2';
    let lead={};
    try{lead=JSON.parse(localStorage.getItem(storageKey)||'{}')||{};}catch(e){lead={};}
    function addMsg(text,who){const d=document.createElement('div');d.className='ess-msg '+who;d.textContent=text;box.appendChild(d);box.scrollTop=box.scrollHeight;}
    function saveLead(){localStorage.setItem(storageKey,JSON.stringify(lead));}
    function validPhone(value){return /^[0-9+\-\s()]{7,25}$/.test(value.trim());}
    function validEmail(value){return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value.trim());}
    function hasLead(){return !!(lead.name&&lead.email&&lead.phone);}
    function showGreetingMode(){leadCard.style.display='none';quick.style.display='none';form.style.display='flex';}
    function showChatReady(){leadCard.style.display='none';quick.style.display='flex';form.style.display='flex';}
    function askLead(){
        form.style.display='none';
        quick.style.display='none';
        leadCard.style.display='grid';
        addMsg('Thank you. Please share your name, email address, and contact number so our team can guide you properly.', 'bot');
    }
    function greet(){
        if(box.children.length)return;
        addMsg('Hello! Welcome to ESS-Track by ESSPL. We help with GPS vehicle tracking, packages, installation, and support. How are you today?', 'bot');
        if(hasLead()){
            showChatReady();
            addMsg('You can ask your question now. For package details, you can also call ESSPL at {{ $chatPhone }}.', 'bot');
        }else{
            showGreetingMode();
        }
    }
    toggle.onclick=()=>{panel.style.display=panel.style.display==='none'?'flex':'none';greet();};
    close.onclick=()=>panel.style.display='none';
    leadSubmit.onclick=()=>{
        const name=leadName.value.trim();const email=leadEmail.value.trim();const phone=leadPhone.value.trim();
        if(name.length<3){addMsg('Please enter your name first.', 'bot');leadName.focus();return;}
        if(!validEmail(email)){addMsg('Please enter a valid email address.', 'bot');leadEmail.focus();return;}
        if(!validPhone(phone)){addMsg('Please enter a valid contact number.', 'bot');leadPhone.focus();return;}
        lead={name,email,phone,language:'english'};saveLead();addMsg('Details submitted.','user');addMsg(`Thank you, ${name}. You can ask me about packages, installation, promotions, or contact details. For package details, you can also call ESSPL at {{ $chatPhone }}.`, 'bot');showChatReady();input.focus();
    };
    async function send(text){
        if(!text.trim())return;addMsg(text,'user');input.value='';
        if(!hasLead()){
            askLead();
            return;
        }
        if(/package|packages|silver|gold|platinum|rental|device/i.test(text)){lead.package_interest=text.trim();saveLead();}
        addMsg('Typing...','bot');
        try{
            const r=await fetch('{{ route('chat.message') }}',{method:'POST',headers:{'Content-Type':'application/json','X-CSRF-TOKEN':'{{ csrf_token() }}','Accept':'application/json'},body:JSON.stringify({message:text,lead})});
            const j=await r.json();box.lastChild.remove();addMsg(j.reply||'Please call {{ $chatPhone }} for accurate package details.','bot');
        }catch(e){box.lastChild.remove();addMsg('Connection error. Please call {{ $chatPhone }} or WhatsApp us.','bot');}
    }
    form.onsubmit=e=>{e.preventDefault();send(input.value);};
    document.querySelectorAll('.ess-chat-quick button').forEach(b=>b.onclick=()=>send(b.dataset.q));
    if(hasLead()){showChatReady();}else{showGreetingMode();}
    greet();
})();
</script>
@endif
