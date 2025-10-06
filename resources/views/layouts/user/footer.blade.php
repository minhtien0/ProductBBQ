<style>
:root {
    --primary: #e60012;
    --deep: #262465;
    --chat-primary: #0b66ff;
    --chat-primary-dark: #0853d1;
}

/* ==================== FOOTER STYLES ==================== */
.footer-section {
    background: linear-gradient(rgba(34, 20, 50, 0.79), rgba(34, 20, 50, 0.79)), url('{{ asset('img/banner1.jpg') }}') center/cover no-repeat;
    padding: 38px 0 0 0;
}

.footer-wrap {
    max-width: 1300px;
    margin: 0 auto;
    padding: 0 24px;
    display: flex;
    justify-content: space-between;
    gap: 42px;
    align-items: flex-start;
    flex-wrap: wrap;
    color: #fff;
}

.footer-col {
    flex: 1 1 185px;
    min-width: 170px;
    margin-bottom: 30px;
}

.footer-col h3 {
    color: var(--primary);
    font-size: 1.17rem;
    font-weight: 800;
    margin-bottom: 16px;
    letter-spacing: .5px;
}

.footer-logo {
    font-size: 1.43rem;
    font-weight: 800;
    color: #fff;
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    gap: 7px;
}

.footer-logo i {
    font-size: 2.2rem;
    color: var(--primary);
}

.footer-desc {
    font-size: 1rem;
    color: #e9e9e9;
    margin-bottom: 16px;
    line-height: 1.5;
}

.footer-social {
    display: flex;
    gap: 9px;
    margin-bottom: 8px;
}

.footer-social a {
    color: #fff;
    background: var(--primary);
    border-radius: 50%;
    width: 34px;
    height: 34px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.13rem;
    transition: background 0.18s, color 0.18s;
    text-decoration: none;
}

.footer-social a:hover {
    background: #fff;
    color: var(--primary);
}

.footer-link-list,
.footer-help-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-link-list li,
.footer-help-list li {
    margin-bottom: 11px;
}

.footer-link-list a,
.footer-help-list a {
    color: #fff;
    text-decoration: none;
    font-size: 1rem;
    transition: color .17s;
}

.footer-link-list a:hover,
.footer-help-list a:hover {
    color: var(--primary);
}

.footer-contact {
    color: #fff;
    font-size: 1rem;
    margin-bottom: 10px;
    line-height: 1.7;
    display: flex;
    flex-direction: column;
    gap: 6px;
}

.footer-contact i {
    color: var(--primary);
    margin-right: 8px;
    font-size: 1.13em;
    min-width: 19px;
    text-align: center;
}

.footer-bottom {
    background: var(--primary);
    color: #fff;
    text-align: center;
    padding: 12px 0 10px 0;
    font-size: 1rem;
    font-weight: 600;
    margin-top: 0;
    position: relative;
    z-index: 2;
    letter-spacing: .4px;
}

/* ==================== SCROLL TO TOP BUTTON ==================== */
.scroll_btn {
    position: fixed;
    bottom: 16px;
    right: 16px;
    width: 48px;
    height: 48px;
    background: var(--primary);
    color: #fff;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    box-shadow: 0 4px 12px rgba(230, 0, 18, 0.3);
    cursor: pointer;
    transition: all 0.3s ease;
    z-index: 999;
}

.scroll_btn:hover {
    background: #c70010;
    transform: translateY(-3px);
    box-shadow: 0 6px 16px rgba(230, 0, 18, 0.4);
}

.scroll_btn.hidden {
    opacity: 0;
    visibility: hidden;
    pointer-events: none;
}

/* ==================== CHATBOT STYLES ==================== */
.chat-popup-wrapper {
    position: fixed;
    right: 20px;
    bottom: 80px;
    z-index: 9998;
    font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
}

.chat-toggle-btn {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--chat-primary), var(--chat-primary-dark));
    color: #fff;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 6px 20px rgba(11, 102, 255, 0.35);
    border: none;
    cursor: pointer;
    font-size: 26px;
    transition: all 0.3s ease;
    animation: pulse 2s infinite;
}

.chat-toggle-btn:hover {
    transform: scale(1.1);
    box-shadow: 0 8px 25px rgba(11, 102, 255, 0.45);
}

@keyframes pulse {
    0%, 100% {
        box-shadow: 0 6px 20px rgba(11, 102, 255, 0.35);
    }
    50% {
        box-shadow: 0 6px 30px rgba(11, 102, 255, 0.6);
    }
}

.chat-popup {
    width: 380px;
    max-width: calc(100vw - 40px);
    height: 520px;
    display: flex;
    flex-direction: column;
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.2);
    overflow: hidden;
    margin-bottom: 12px;
    animation: slideUp 0.3s ease-out;
    color: #000;
}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.chat-header {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 16px;
    background: linear-gradient(135deg, var(--chat-primary), var(--chat-primary-dark));
    color: #fff;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.chat-header .title {
    font-weight: 700;
    font-size: 16px;
    flex: 1;
    letter-spacing: 0.3px;
}

.chat-header .actions {
    display: flex;
    gap: 8px;
}

.chat-header button {
    background: rgba(255, 255, 255, 0.2);
    border: none;
    color: #fff;
    cursor: pointer;
    font-size: 18px;
    width: 32px;
    height: 32px;
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background 0.2s;
}

.chat-header button:hover {
    background: rgba(255, 255, 255, 0.3);
}

.chat-messages {
    flex: 1;
    padding: 16px;
    overflow-y: auto;
    background: linear-gradient(to bottom, #f8faff 0%, #fff 100%);
    scrollbar-width: thin;
    scrollbar-color: #ddd #f0f0f0;
}

.chat-messages::-webkit-scrollbar {
    width: 6px;
}

.chat-messages::-webkit-scrollbar-track {
    background: #f0f0f0;
    border-radius: 10px;
}

.chat-messages::-webkit-scrollbar-thumb {
    background: #ddd;
    border-radius: 10px;
}

.chat-messages::-webkit-scrollbar-thumb:hover {
    background: #ccc;
}

.msg {
    margin: 10px 0;
    max-width: 80%;
    word-break: break-word;
    animation: fadeIn 0.3s ease;
    color: #000;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(5px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.msg.user {
    margin-left: auto;
    text-align: right;
    color: #000;
}

.msg.user > div {
    background: var(--chat-primary);
    color: #fff;
    padding: 10px 14px;
    border-radius: 16px 16px 4px 16px;
    display: inline-block;
    box-shadow: 0 2px 8px rgba(11, 102, 255, 0.2);
}

.msg.bot > div {
    background: #f1f3f9;
    color: #000;
    padding: 10px 14px;
    border-radius: 16px 16px 16px 4px;
    display: inline-block;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
}

.card {
    border: 1px solid #e8ecf5;
    background: #fff;
    padding: 12px;
    border-radius: 12px;
    display: flex;
    gap: 12px;
    align-items: center;
    box-shadow: 0 3px 10px rgba(11, 102, 255, 0.08);
    transition: transform 0.2s, box-shadow 0.2s;
    cursor: pointer;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(11, 102, 255, 0.15);
}

.card img {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 8px;
    cursor: pointer;
}

.card .card-body {
    flex: 1;
    min-width: 0;
}

.card .card-title {
    font-weight: 600;
    font-size: 14px;
    margin-bottom: 6px;
    cursor: pointer;
    color: var(--chat-primary);
    line-height: 1.4;
}

.card .card-sub {
    font-size: 12px;
    color: #666;
    line-height: 1.4;
}

.chat-input {
    display: flex;
    gap: 10px;
    padding: 14px;
    border-top: 1px solid #eee;
    background: #fff;
}

.chat-input input {
    flex: 1;
    padding: 12px 16px;
    border-radius: 24px;
    border: 1px solid #e0e4ee;
    outline: none;
    font-size: 14px;
    transition: border-color 0.2s;
}

.chat-input input:focus {
    border-color: var(--chat-primary);
}

.chat-input button.send {
    background: linear-gradient(135deg, var(--chat-primary), var(--chat-primary-dark));
    color: #fff;
    border: none;
    padding: 12px 20px;
    border-radius: 24px;
    cursor: pointer;
    font-weight: 600;
    font-size: 14px;
    transition: all 0.2s;
    box-shadow: 0 3px 10px rgba(11, 102, 255, 0.25);
}

.chat-input button.send:hover {
    transform: translateY(-1px);
    box-shadow: 0 5px 15px rgba(11, 102, 255, 0.35);
}

.chat-input button.send:active {
    transform: translateY(0);
}

.chat-empty {
    color: #888;
    font-size: 14px;
    text-align: center;
    padding: 20px;
    line-height: 1.6;
}

.chat-empty i {
    color: var(--chat-primary);
    font-style: normal;
    font-weight: 600;
}

/* ==================== RESPONSIVE STYLES ==================== */
@media (max-width: 970px) {
    .footer-wrap {
        gap: 26px;
    }

    .footer-col {
        min-width: 45vw;
    }
}

@media (max-width: 640px) {
    .footer-wrap {
        flex-direction: column;
        gap: 0;
    }

    .footer-col {
        min-width: 100%;
        margin-bottom: 22px;
    }

    .footer-section {
        padding: 22px 0 0 0;
    }

    .footer-bottom {
        font-size: .96em;
    }

    .scroll_btn {
        width: 44px;
        height: 44px;
        bottom: 12px;
        right: 12px;
    }
}

@media (max-width: 480px) {
    .chat-popup-wrapper {
        right: 10px;
        bottom: 70px;
    }

    .chat-popup {
        width: calc(100vw - 20px);
        height: 500px;
    }

    .chat-toggle-btn {
        width: 56px;
        height: 56px;
        font-size: 24px;
    }

    .card img {
        width: 64px;
        height: 64px;
    }

    .chat-header {
        padding: 14px;
    }

    .chat-messages {
        padding: 12px;
    }

    .chat-input {
        padding: 12px;
    }
}
</style>

<body>
<!-- Chatbot Popup -->
<div class="chat-popup-wrapper">
    <div id="chatPopup" class="chat-popup" style="display:none;">
        <div class="chat-header">
            <div class="title">💬 Chat với Nhà Hàng</div>
            <div class="actions">
                <button id="minimizeBtn" title="Thu nhỏ" aria-label="Thu nhỏ">—</button>
                <button id="closeBtn" title="Đóng" aria-label="Đóng">×</button>
            </div>
        </div>
        
        <div id="messages" class="chat-messages" aria-live="polite">
            <div class="chat-empty">
                👋 Xin chào! Gõ <i>"help"</i> để xem các lệnh.<br>
                Ví dụ: <i>tìm món phở</i>
            </div>
        </div>

        <div class="chat-input">
            <input id="message" type="text" placeholder="Gõ tin nhắn..." aria-label="Nhập tin nhắn">
            <button id="send" class="send" aria-label="Gửi tin nhắn">Gửi</button>
        </div>
    </div>

    <button id="toggleBtn" class="chat-toggle-btn" title="Mở chat" aria-label="Mở chat">💬</button>
</div>

<!-- Scroll to Top Button -->
<div class="scroll_btn hidden" role="button" tabindex="0" aria-label="Cuộn lên đầu trang">
    <i class="fas fa-arrow-up" aria-hidden="true"></i>
</div>

<!-- Footer Section -->
<section>
    <footer>
        <div class="footer-section overflow-x-hidden">
            <div class="footer-wrap w-full max-w-[1300px] mx-auto px-6 flex flex-wrap justify-between gap-6 md:gap-10 overflow-hidden">
                <!-- Logo & Social -->
                <div class="footer-col flex-1">
                    <div class="footer-logo">
                        <i class="fa-solid fa-utensils"></i> LUA BE HOY
                    </div>
                    <div class="footer-desc">
                        Lua Be Hoy là điểm đến lý tưởng dành cho những tín đồ yêu thích món nướng. Với không gian hiện đại, ấm cúng và phong cách phục vụ chuyên nghiệp.
                    </div>
                    <div class="footer-social">
                        <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
                
                <!-- Short Link -->
                <div class="footer-col flex-1 flex flex-col items-center">
                    <h3 class="text-center mb-2">Liên Kết</h3>
                    <ul class="footer-link-list text-center">
                        <li><a href="{{ route('views.index') }}">Trang Chủ</a></li>
                        <li><a href="{{ route('views.about') }}">Giới Thiệu</a></li>
                        <li><a href="{{ route('views.contact') }}">Liên Hệ</a></li>
                        <li><a href="{{ route('views.blog') }}">Tin Tức</a></li>
                    </ul>
                </div>
                
                <!-- Contact -->
                <div class="footer-col flex-1">
                    <h3>Liên hệ với chúng tôi</h3>
                    <div class="footer-contact">
                        <div><i class="fa fa-phone"></i>{{ $infos->sdt }}</div>
                        <div><i class="fa fa-envelope"></i>{{ $infos->email }}</div>
                        <div><i class="fa fa-location-dot"></i>{{ $infos->address }}</div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</section>

<script>
// ==================== SCROLL TO TOP FUNCTIONALITY ====================
document.addEventListener("DOMContentLoaded", () => {
    const scrollBtn = document.querySelector('.scroll_btn');
    
    if (!scrollBtn) return;

    const toggleScrollButton = () => {
        if (window.scrollY > 300) {
            scrollBtn.classList.remove('hidden');
        } else {
            scrollBtn.classList.add('hidden');
        }
    };

    window.addEventListener('scroll', toggleScrollButton);
    
    scrollBtn.addEventListener('click', () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });

    // Keyboard accessibility
    scrollBtn.addEventListener('keydown', (e) => {
        if (e.key === 'Enter' || e.key === ' ') {
            e.preventDefault();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    });
});

// ==================== CHATBOT FUNCTIONALITY ====================
document.addEventListener('DOMContentLoaded', function() {
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    const toggleBtn = document.getElementById('toggleBtn');
    const chatPopup = document.getElementById('chatPopup');
    const minimizeBtn = document.getElementById('minimizeBtn');
    const closeBtn = document.getElementById('closeBtn');
    const messagesEl = document.getElementById('messages');
    const messageInput = document.getElementById('message');
    const sendBtn = document.getElementById('send');

    if (!toggleBtn || !chatPopup || !messagesEl) return;

    // Toggle Functions
    const openPopup = () => {
        chatPopup.style.display = 'flex';
        toggleBtn.style.display = 'none';
        setTimeout(() => messageInput?.focus(), 150);
    };

    const closePopup = () => {
        chatPopup.style.display = 'none';
        toggleBtn.style.display = 'inline-flex';
    };

    // Event Listeners
    toggleBtn.addEventListener('click', openPopup);
    minimizeBtn?.addEventListener('click', closePopup);
    closeBtn?.addEventListener('click', closePopup);

    // Message Rendering
    const appendMessage = (text, type = 'bot') => {
        const msgEl = document.createElement('div');
        msgEl.className = `msg ${type}`;
        
        const textEl = document.createElement('div');
        textEl.style.whiteSpace = 'pre-wrap';
        textEl.textContent = text;
        
        msgEl.appendChild(textEl);
        messagesEl.appendChild(msgEl);
        messagesEl.scrollTop = messagesEl.scrollHeight;
    };

    const appendCard = (card) => {
        const container = document.createElement('div');
        container.className = 'msg bot card';

        const img = document.createElement('img');
        img.src = card.image;
        img.alt = card.title || 'Dish image';
        img.loading = 'lazy';
        
        const body = document.createElement('div');
        body.className = 'card-body';

        const title = document.createElement('div');
        title.className = 'card-title';
        title.textContent = card.title;

        const subtitle = document.createElement('div');
        subtitle.className = 'card-sub';
        subtitle.textContent = card.subtitle || '';

        body.appendChild(title);
        body.appendChild(subtitle);
        container.appendChild(img);
        container.appendChild(body);

        // Click handlers
        const openLink = () => card.url && window.open(card.url, '_blank');
        img.addEventListener('click', openLink);
        title.addEventListener('click', openLink);
        container.style.cursor = 'pointer';

        messagesEl.appendChild(container);
        messagesEl.scrollTop = messagesEl.scrollHeight;
    };

    // Send Message
    const sendMessage = () => {
        const text = messageInput.value.trim();
        if (!text) return;

        // Remove empty hint
        const emptyHint = messagesEl.querySelector('.chat-empty');
        if (emptyHint) emptyHint.remove();

        // Display user message
        appendMessage(text, 'user');
        messageInput.value = '';

        // Prepare request
        const formData = new URLSearchParams();
        formData.append('message', text);

        fetch('{{ route("botman.handle") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
                'X-CSRF-TOKEN': csrfToken || '',
                'Accept': 'application/json'
            },
            body: formData.toString()
        })
        .then(response => response.json())
        .then(data => {
            if (!data?.messages) {
                appendMessage('❌ Bot không trả về dữ liệu hợp lệ', 'bot');
                return;
            }

            data.messages.forEach(msg => {
                if (msg.type === 'text') {
                    appendMessage(msg.text || msg, 'bot');
                } else if (msg.type === 'card') {
                    appendCard(msg);
                } else {
                    appendMessage(JSON.stringify(msg), 'bot');
                }
            });
        })
        .catch(error => {
            console.error('Chat error:', error);
            appendMessage('❌ Lỗi kết nối. Vui lòng thử lại!', 'bot');
        });
    };

    // Event Listeners for sending
    sendBtn?.addEventListener('click', sendMessage);
    messageInput?.addEventListener('keydown', (e) => {
        if (e.key === 'Enter') {
            e.preventDefault();
            sendMessage();
        }
    });

    // Initialize
    chatPopup.style.display = 'none';
    toggleBtn.style.display = 'inline-flex';
});
</script>
</body>