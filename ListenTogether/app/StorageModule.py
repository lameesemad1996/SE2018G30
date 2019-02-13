from app import db


class User(db.Model):
    __tablename__ = "user"
    UserID = db.Column(db.Integer, primary_key=True)
    username = db.Column(db.String(64), index=True, unique=True)
    password = db.Column(db.String(128))
    profile = db.relationship('Profile', uselist=False, back_populates="user")

    def __repr__(self):
        return '<Username {}>'.format(self.username)


class Profile(db.Model):
    __tablename__ = "profile"
    ProfileID = db.Column(db.Integer, primary_key=True)
    Nickname = db.Column(db.String(128), index=True)
    Email = db.Column(db.String(128), unique=True)
    UserID = db.Column(db.Integer, db.ForeignKey('user.UserID'))
    user = db.relationship("User", back_populates="profile")
    friends = db.relationship('Friend', backref='centerProfile', lazy='dynamic')
    songs = db.relationship('PlayList', backref='playListOwner', lazy='dynamic')

    def __repr__(self):
        return '<Nickname {}>'.format(self.Nickname)


class Friend(db.Model):
    __tablename__ = "friend"
    ID = db.Column(db.Integer, primary_key=True)
    UserID = db.Column(db.Integer, db.ForeignKey('profile.UserID'))
    FriendID = db.Column(db.Integer)

    def __repr__(self):
        return '<FriendID {}>'.format(self.FriendID)


class PlayList(db.Model):
    __tablename__ = "playlist"
    ID = db.Column(db.Integer, primary_key=True)
    PlayListName = db.Column(db.String(128))
    SongName = db.Column(db.String(128))
    UserID = db.Column(db.Integer, db.ForeignKey('profile.UserID'))

    def __repr__(self):
        return '<Songname: {}>'.format(self.SongName)




