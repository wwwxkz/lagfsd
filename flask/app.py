from flask import Flask
from sqlalchemy import create_engine, select, MetaData, Table, Column, Integer, String, DateTime
from sqlalchemy.inspection import inspect
from sqlalchemy.sql import func
from datetime import timedelta, date

app = Flask(__name__)

# Connection

engine = create_engine("mysql+pymysql://flask:password@flask-db/flask?charset=utf8mb4")
connection = engine.connect()

metadata = MetaData()
metadata.reflect(bind=engine)

# Models

announces_table_name = 'announces'
announces_table = Table(
    announces_table_name,
    metadata,
    Column('id', Integer, primary_key=True, autoincrement=True),
    Column('name', String(32)),
    Column('until', DateTime()),
    Column('created_at', DateTime(timezone=True), server_default=func.now()),
    Column('updated_at', DateTime(timezone=True), onupdate=func.now()),
    extend_existing=True
)

inspector = inspect(engine)
table_exists = inspector.has_table(announces_table_name)

if not table_exists:
    metadata.create_all(bind=engine)

# Session

with engine.connect() as conn:
    # Insert
    conn.execute(announces_table.insert().values(
        name = 'Cardbox',
        until = date.today() + timedelta(days=10)
    ))
    conn.execute(announces_table.insert().values(
        name = 'Knife',
        until = date.today() + timedelta(days=5)
    ))

    # Query
    query = announces_table.select()
    results = conn.execute(query)

    last_announce = ''
    for result in results:
        last_announce = result
        print(result.id, result.name, str(result.until))

# Routes

@app.route('/')
def home():
    return '<h1>Last announce ' + last_announce + ' </h2>'

if __name__ == "__main__":
    app.run(debug=True)
