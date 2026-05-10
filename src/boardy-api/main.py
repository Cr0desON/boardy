from fastapi import FastAPI
from datetime import datetime
from routers import comments
from fastapi.middleware.cors import CORSMiddleware

import aiomysql
 
app = FastAPI(title='Boardy API', version='0.2.0')
app.include_router(comments.router)
app.add_middleware(
    CORSMiddleware,
    allow_origins=[
        "https://boardy.crodes.ai-info.ru",
    ],
    allow_credentials=True,
    allow_methods=["*"],  # GET, POST, PUT, DELETE
    allow_headers=["*"],
)


 
DB_CONFIG = {
    'host': '127.0.0.1',
    'port': 3306,
    'user': 'boardy',
    'password': '123abcD!',
    'db': 'boardy',
    'charset': 'utf8mb4',
}
 
async def get_db():
    return await aiomysql.connect(**DB_CONFIG)
 
@app.get('/api/status')
async def status():
    return {'status': 'ok', 'time': str(datetime.now())}
 
@app.get('/api/messages')
async def get_messages():
    conn = await get_db()
    async with conn.cursor(aiomysql.DictCursor) as cur:
        await cur.execute(
            'SELECT posts.body AS message, users.name, '
            'posts.created_at FROM posts '
            'JOIN users ON posts.author_id = users.id '
            'ORDER BY posts.created_at DESC'
        )
        messages = await cur.fetchall()
    conn.close()
    for m in messages:
        m['created_at'] = str(m['created_at'])
    return {'messages': messages, 'count': len(messages)}
 
@app.get('/api/users')
async def get_users():
    conn = await get_db()
    async with conn.cursor(aiomysql.DictCursor) as cur:
        await cur.execute(
            'SELECT id, name, email, created_at FROM users'
        )
        users = await cur.fetchall()
    conn.close()
    for u in users:
        u['created_at'] = str(u['created_at'])
    return {'users': users, 'count': len(users)}

@app.get('/comments')
async def get_comments():
    conn = await get_db()
    async with conn.cursor(aiomysql.DictCursor) as cur:
        await cur.execute('SELECT * FROM comments')
        comments = await cur.fetchall()
    conn.close()
    for com in comments:
        com['created_at'] = str(com['created_at'])
    return {'comments': comments, 'count': len(comments)}
