from app import app
from flask import request
from StorageModule import User
from StorageModule import Profile
from StorageModule import Friend
from app import db


@app.route('/signup')
def signup_handler():
    username = request.args.get('username')
    password = request.args.get('password')
    if User.query.filter_by(username=username).first():
        return "Username is used"
    else:
        user = User(username=username, password=password)
        db.session.add(user)
        db.session.commit()
        return "Success"


@app.route('/login')
def authorization_handler():
    user_username = request.args.get('username')
    user_password = request.args.get('password')

    filtered_user = User.query.filter_by(username=user_username).first()

    if not filtered_user:
        return "Username does not exist"
    elif filtered_user.password != user_password:
        return "Password incorrect"
    else:
        return "Welcome"


@app.route('/fill_profile')
def profile_fill_handler():
    username = request.args.get('username')
    nickname = request.args.get('nickname')
    email = request.args.get('email')

    filtered_user = User.query.filter_by(username=username).first()

    if not filtered_user:
        return "Username does not exist"
    else:
        profile = Profile(Nickname=nickname, Email=email, user=filtered_user)
        db.session.add(profile)
        db.session.commit()
        return "Profile filled"

@app.route('/edit_profile')
def edit_profile_handler():
    username = request.args.get('username')
    nickname = request.args.get('nickname')
    email = request.args.get('email')

    filtered_user = User.query.filter_by(username=username).first()

    if not filtered_user:
        return "Username does not exist"
    else:
        filtered_profile = filtered_user.profile
        filtered_profile.Nickname = nickname
        filtered_profile.Email = email
        db.session.commit()
        return "Success"


@app.route('/retrieve_profile')
def retrieve_profile_handler():
    user_id = request.args.get('user_id')

    filtered_user = User.query.get(user_id)

    if not filtered_user:
        return "Profile not found"
    else:
        return "Nickname: " + filtered_user.profile.Nickname + "\n" + "Email: " + filtered_user.profile.Email


@app.route('/follow_friend')
def follow_friend_handler():
    username = request.args.get('username')
    friend_id = request.args.get('friend_id')

    filtered_user = User.query.filter_by(username=username).first()
    filtered_friend = User.query.get(friend_id)

    if not filtered_user:
        return "User does not exist"
    elif not filtered_friend:
        return "Friend does not exist"
    else:
        friend = Friend(FriendID=friend_id, centerProfile=filtered_user.profile)
        db.session.add(friend)
        db.session.commit()
        return "Friend followed successfully"


@app.route('/search_user')
def search_user():
    nickname = request.args.get('nickname')

    profiles = Profile.query.filter(Profile.Nickname.like("%"+nickname+"%")).all()

    returnable = ""

    for p in profiles:
        returnable += str(p.Nickname) + " " + str(p.UserID) + "\n"
    return returnable


@app.route('/test')
def test_handler():
    username = request.args.get('username')

    filtered_user = User.query.filter_by(username=username).first()

    return "UserID: " + str(filtered_user.UserID) + " Name: " + str(filtered_user.profile.Nickname)
