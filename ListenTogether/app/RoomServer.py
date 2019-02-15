import asyncore
import socket
from threading import Thread
from app import yt_api

class CommunicationHandler(asyncore.dispatcher_with_send):

    def __init__(self, sock, room):
        asyncore.dispatcher_with_send.__init__(self, sock)
        self.room = room

    def handle_read(self):
        data = self.recv(8192)
        if data:
            data_string = data.decode('ascii')
            if data_string == 'resume':
                self.room.player_state = 1
                msg = str(self.room.player_state)
                self.send(msg.encode('ascii'))
            elif data_string == 'pause':
                self.room.player_state = 0
                msg = str(self.room.player_state)
                self.send(msg.encode('ascii'))
            elif data_string == 'state':
                msg = str(self.room.player_state)
                self.send(msg.encode('ascii'))
            elif data_string.__contains__('seek'):
                parts = data_string.partition(" ")
                self.room.time = parts[1]
            elif data_string == 'time':
                msg = self.room.time
                self.send(msg.encode('ascii'))
            elif data_string == 'url':
                msg = self.room.url
                self.send(msg.encode('ascii'))
            else:
                self.room.url = yt_api.search_song(data_string)


class RoomServer(asyncore.dispatcher):

    def __init__(self, host, port):
        asyncore.dispatcher.__init__(self)
        self.create_socket(socket.AF_INET, socket.SOCK_STREAM)
        self.set_reuse_addr()
        self.bind((host, port))
        self.listen(5)
        self.port = port
        self.player_state = 0
        self.url = ""
        self.time = 0
        print("Created a room server")

    def handle_accept(self):
        pair = self.accept()
        if pair is not None:
            sock,addr = pair
            print('Incoming connection from %s' % repr(addr))
            handler = CommunicationHandler(sock, room=self)


def asyncore_loop():
    while True:
        asyncore.loop()


t1 = Thread(target=asyncore_loop)
t1.setDaemon(True)
t1.start()
