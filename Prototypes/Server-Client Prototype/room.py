import socket

s = socket.socket()

print("successfully created a socket")

port = 12345

s.bind(('', port))

print("socket binded to %s" % port)

s.listen(5)

print("socket is listening")

while True:
    c, addr = s.accept()
    print("Got connection from", addr)
    c.send(str.encode("Thank you for connecting"))
    c.close()

