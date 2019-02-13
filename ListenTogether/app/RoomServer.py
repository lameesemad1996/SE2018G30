import asyncore
import socket
import sys


class CommunicationHandler(asyncore.dispatcher_with_send):
    def handle_read(self):
        data = self.recv(1024)
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

    def handle_accepted(self, sock, addr):
        print('Incoming connection from %s' % repr(addr))
        handler = CommunicationHandler(sock)

    def handle_connect(self):
        print("handle connect")

    def handle_connect_event(self):
        print ("Handle connect event")

    def handle_error(self):
        print("handle error")

    def handle_expt(self):
        print("handle expt")

    def handle_expt_event(self):
        print("hee")

print("looping")
asyncore.loop()
print("still")