from app import RoomServer

starting_port = 1234
rooms = []


def determine_port():
    return len(rooms) + starting_port


def create_room():
    room = RoomServer.RoomServer("0.0.0.0", determine_port())
    rooms.append(room)
    return room.port

