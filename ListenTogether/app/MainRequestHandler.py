from app import app
from flask import request
from app import StorageModule
from app import db
import time
from app import RoomServerSpawner

user_status = {}

@app.route('/signup')
def signup_handler():
    username = request.args.get('username')
    password = request.args.get('password')
    if StorageModule.User.query.filter_by(username=username).first():
        return "Username is used"
    else:
        user = StorageModule.User(username=username, password=password)
        db.session.add(user)
        db.session.commit()
        return "Success"


@app.route('/login')
def authorization_handler():
    user_username = request.args.get('username')
    user_password = request.args.get('password')

    filtered_user = StorageModule.User.query.filter_by(username=user_username).first()

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

    filtered_user = StorageModule.User.query.filter_by(username=username).first()

    if not filtered_user:
        return "Username does not exist"
    else:
        profile = StorageModule.Profile(Nickname=nickname, Email=email, user=filtered_user)
        db.session.add(profile)
        db.session.commit()
        return "Profile filled"


@app.route('/create_playlist')
def create_playlist_handler():
    username = request.args.get('username')
    playlist_name = request.args.get('playlist_name')
    song_name = request.args.get('song_name')

    filtered_user = StorageModule.User.query.filter_by(username=username).first()

    if not filtered_user:
        return "Username does not exist"
    else:
        filtered_profile = filtered_user.profile
        playlist = StorageModule.PlayList(PlayListName=playlist_name, SongName=song_name, playListOwner=filtered_profile)

        db.session.add(playlist)
        db.session.commit()

        return "Success"


@app.route('/retrieve_playlist')
def retrieve_playlist_handler():
    username = request.args.get('username')

    filtered_user = StorageModule.User.query.filter_by(username=username).first()

    if not filtered_user:
        return "Username does not exist"
    else:
        filtered_profile = filtered_user.profile
        songs = filtered_profile.songs
        returnable = ""
        for song in songs:
            returnable += str(song.ID) + " " + str(song.PlayListName) + " " + str(song.SongName) + ","

        return returnable


@app.route('/remove_song')
def remove_song_handler():
    song_id = request.args.get('song_id')

    filtered_song = StorageModule.PlayList.query.get(song_id)

    if not filtered_song:
        return "Song does not exist"
    else:
        db.session.delete(filtered_song)
        db.session.commit()
        return "Success"


@app.route('/edit_profile')
def edit_profile_handler():
    username = request.args.get('username')
    nickname = request.args.get('nickname')
    email = request.args.get('email')

    filtered_user = StorageModule.User.query.filter_by(username=username).first()

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

    filtered_user = StorageModule.User.query.get(user_id)

    if not filtered_user:
        return "Profile not found"
    else:
        return filtered_user.profile.Nickname + "," + filtered_user.profile.Email


@app.route('/follow_friend')
def follow_friend_handler():
    username = request.args.get('username')
    friend_id = request.args.get('friend_id')

    filtered_user = StorageModule.User.query.filter_by(username=username).first()
    filtered_friend = StorageModule.User.query.get(friend_id)

    if not filtered_user:
        return "User does not exist"
    elif not filtered_friend:
        return "Friend does not exist"
    else:
        friend = StorageModule.Friend(FriendID=friend_id, centerProfile=filtered_user.profile)
        db.session.add(friend)
        db.session.commit()
        return "Friend followed successfully"


@app.route('/retrieve_friends')
def retreieve_friends_handler():
    username = request.args.get('username')

    filtered_user = StorageModule.User.query.filter_by(username=username).first()

    if not filtered_user:
        return "Username does not exist"
    else:
        filtered_profile = filtered_user.profile
        friends = filtered_profile.friends
        returnable = ""
        for friend in friends:
            filtered_friend_profile = StorageModule.User.query.get(friend.FriendID).profile
            returnable += str(friend.ID) + " " + str(filtered_friend_profile.Nickname) + ","

        return returnable


@app.route('/search_user')
def search_user():
    nickname = request.args.get('nickname')

    profiles = StorageModule.Profile.query.filter(StorageModule.Profile.Nickname.like("%"+nickname+"%")).all()

    returnable = ""

    for p in profiles:
        returnable += str(p.Nickname) + " " + str(p.UserID) + ","
    return returnable


@app.route('/update_status')
def update_status_handler():
    global user_status

    username = request.args.get('username')

    filtered_user = StorageModule.User.query.filter_by(username=username).first()

    if not filtered_user:
        return "Username does not exist"
    else:
        user_status[filtered_user.UserID] = time.time()
        return "Success"


@app.route('/is_online')
def is_online_handler():
    global user_status

    user_id = request.args.get('user_id')

    filtered_user = StorageModule.User.query.get(user_id)

    if not filtered_user:
        return "User does not exist"
    else:
        time_now = time.time()

        if time_now - user_status.get(filtered_user.UserID, 0) < 30:
            return "online"
        else:
            return "offline"


@app.route('/create_room')
def create_room():
    return str(RoomServerSpawner.create_room())


@app.route('/test')
def test_handler():
    username = request.args.get('username')

    filtered_user = StorageModule.User.query.filter_by(username=username).first()

    return str(filtered_user.UserID) + " " + str(filtered_user.profile.Nickname)
