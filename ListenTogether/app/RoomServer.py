import asyncore
import socket
from threading import Thread

class CommunicationHandler(asyncore.dispatcher_with_send):
    def handle_read(self):
        data = self.recv(8192)
        if data:
            self.send(data)


class RoomServer(asyncore.dispatcher):

    def __init__(self, host, port):
        asyncore.dispatcher.__init__(self)
        self.create_socket(socket.AF_INET, socket.SOCK_STREAM)
        self.set_reuse_addr()
        self.bind((host, port))
        self.listen(5)
        self.port = port
        print("Created a room server")

    def handle_accept(self):
        pair = self.accept()
        if pair is not None:
            sock,addr = pair
            print('Incoming connection from %s' % repr(addr))
            handler = CommunicationHandler(sock)


def asyncoreLoop():
    while True:
        asyncore.loop()

t1 = Thread(target=asyncoreLoop)
t1.setDaemon(True)
t1.start()
