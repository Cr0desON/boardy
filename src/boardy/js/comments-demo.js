const API = 'https://boardy.crodes.ai-info.ru';
const POST_ID = 1;

function esc(str) {
    const div = document.createElement('div');
    div.textContent = str;
    return div.innerHTML;
}

async function loadComments() {
    const res = await fetch(`${API}/api/posts/${POST_ID}/comments`);
    const data = await res.json();
    document.getElementById('list').innerHTML = data.comments.map(comment =>
        `<div>
            <strong>${esc(comment.author_name)}</strong>
            <p>${esc(comment.body)}</p>
        </div>`).join('');
}

document.getElementById('btn').addEventListener('click', async () => {
    const body = document.getElementById('body').value.trim();
    if (!body) return;
    await fetch(`${API}/api/posts/${POST_ID}/comments`, {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({body: body})
    });
    document.getElementById('body').value = '';
    loadComments();
});

loadComments();