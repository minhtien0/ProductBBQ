<!doctype html>
<html>
<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Chat with Bot</title>
  <style>
    /* CSS nhỏ cho chat box */
    .chat { width: 400px; margin: 30px auto; border:1px solid #ddd; padding:10px; border-radius:8px; }
    .messages { height: 300px; overflow:auto; border:1px solid #eee; padding:8px; margin-bottom:8px; }
    .msg { margin:6px 0; }
    .user { text-align:right; }
    .bot { text-align:left; color:#0b66ff; }
  </style>
</head>
<body>
  <div class="chat">
    <div class="messages" id="messages"></div>
    <input id="message" placeholder="Gõ tin nhắn..." style="width:75%">
    <button id="send">Gửi</button>
  </div>

<script>
document.addEventListener('DOMContentLoaded', function(){
  const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

  function appendMessage(text, cls='bot'){
    const el = document.createElement('div');
    el.className = 'msg ' + cls;
    // escape text to avoid XSS
    el.textContent = text;
    document.getElementById('messages').appendChild(el);
    document.getElementById('messages').scrollTop = 1e9;
  }

  function appendCard(card){
    // card = { title, subtitle, image, url }
    const container = document.createElement('div');
    container.className = 'msg bot card';
    container.style.border = '1px solid #eee';
    container.style.padding = '8px';
    container.style.margin = '6px 0';
    container.style.borderRadius = '6px';
    container.style.display = 'flex';
    container.style.gap = '8px';
    container.style.alignItems = 'center';

    const imgWr = document.createElement('div');
    imgWr.style.flex = '0 0 80px';
    const img = document.createElement('img');
    img.src = card.image;
    img.style.width = '80px';
    img.style.height = '80px';
    img.style.objectFit = 'cover';
    img.style.borderRadius = '6px';
    img.style.cursor = 'pointer';
    img.addEventListener('click', function(){ window.open(card.url, '_blank'); });
    imgWr.appendChild(img);

    const body = document.createElement('div');
    body.style.flex = '1';
    const title = document.createElement('div');
    title.textContent = card.title;
    title.style.fontWeight = '600';
    title.style.cursor = 'pointer';
    title.addEventListener('click', function(){ window.open(card.url, '_blank'); });

    const subtitle = document.createElement('div');
    subtitle.textContent = card.subtitle;
    subtitle.style.fontSize = '0.9em';
    subtitle.style.marginTop = '6px';
    subtitle.style.color = '#333';

    body.appendChild(title);
    body.appendChild(subtitle);

    container.appendChild(imgWr);
    container.appendChild(body);

    document.getElementById('messages').appendChild(container);
    document.getElementById('messages').scrollTop = 1e9;
  }

  document.getElementById('send').addEventListener('click', send);
  document.getElementById('message').addEventListener('keydown', function(e){
    if (e.key === 'Enter') send();
  });

  function send(){
    const text = document.getElementById('message').value.trim();
    if (!text) return;
    appendMessage(text, 'user');
    document.getElementById('message').value = '';

    // gửi form-urlencoded
    const form = new URLSearchParams();
    form.append('message', text);

    fetch('{{ route("botman.handle") }}', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
        'X-CSRF-TOKEN': token,
        'Accept': 'application/json'
      },
      body: form.toString()
    })
    .then(r => r.json())
    .then(data => {
      if (!data || !data.messages) {
        appendMessage('Bot không trả dữ liệu hợp lệ', 'bot');
        return;
      }

      data.messages.forEach(m => {
        if (m.type === 'text') {
          appendMessage(m.text || m, 'bot');
        } else if (m.type === 'card') {
          appendCard(m);
        } else {
          // unknown type -> print JSON
          appendMessage(JSON.stringify(m), 'bot');
        }
      });
    })
    .catch(err => {
      console.error(err);
      appendMessage('Lỗi kết nối đến bot', 'bot');
    });
  }
});
</script>

</body>
</html>
