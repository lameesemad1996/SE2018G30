from flask import Flask
from app import config
from flask_sqlalchemy import SQLAlchemy

app = Flask(__name__)
app.config.from_object(config.Config)
db = SQLAlchemy(app)

# if __name__ == "__main__":
#     app.run(debug=True, host="0.0.0.0")

#from app import MainRequestHandler, StorageModule

from app.MainRequestHandler import *
from app.StorageModule import *

if __name__ == "__main__":
    app.run(debug=True, host="0.0.0.0")
