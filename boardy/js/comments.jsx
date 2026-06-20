const { useState, useEffect } = React;
const API = 'http://localhost:8080';
const POST_ID = 1;

function CommentsList() {
    const [comments, setComments] = useState([]);
    const [text, setText] = useState('');
    const [editId, setEditId] = useState(null);
    const [editText, setEditText] = useState('');

    const save = async (id) => {
        await fetch(`${API}/api/comments/${id}`, {
            method: 'PUT',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({body: editText})
        });
        setEditId(null);
        load();
    };

    const add = async () => {
        if (!text.trim()) return;
        await fetch(`${API}/api/posts/${POST_ID}/comments`, {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({body: text})
        });
        setText('');
        load();
    };

    const load = async () => {
        const res = await fetch(`${API}/api/posts/${POST_ID}/comments`);
        const data = await res.json();
        setComments(data.comments);
    };

    const del = async (id) => {
        if (!confirm('Удалить?')) return;
        await fetch(`${API}/api/comments/${id}`, {method: 'DELETE'});
        load();
    };

    useEffect(() => { load(); }, []);

    return (
        <div>
            {comments.map(comment => (
                <div key={comment.id} className="card mb-2">
                    <div className="card-body">
                        <strong>{comment.author_name}</strong>
                        <p>{comment.body}</p>
                    </div>
                    {editId === comment.id ? (
                        <div className="input-group">
                            <input className="form-control" value={editText}
                                   onChange={e => setEditText(e.target.value)} />
                            <button className="btn btn-success" onClick={() => save(comment.id)}>
                                Сохранить</button>
                            <button className="btn btn-secondary" onClick={() => setEditId(null)}>
                                Отмена</button>
                        </div>
                    ) : (
                        <div>
                            <p>{comment.body}</p>
                            <button className="btn btn-sm btn-outline-secondary"
                                    onClick={() => { setEditId(comment.id); setEditText(comment.body); }}>
                                ✏️</button>
                            <button className="btn btn-sm btn-outline-danger"
                                    onClick={() => del(comment.id)}>🗑️</button>
                        </div>
                    )}
                </div>
            ))}
            <div className="input-group mt-3">
                <input
                    className="form-control"
                    placeholder="Комментарий"
                    value={text}
                    onChange={e => setText(e.target.value)}
                />
                <button className="btn btn-primary" onClick={add}>
                    Отправить
                </button>
            </div>
        </div>
    );
}

ReactDOM.createRoot(document.getElementById('app')).render(<CommentsList />);
