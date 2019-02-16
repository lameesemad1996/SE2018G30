package com.example.lamee.myapplication;

import android.content.Context;
import android.graphics.Color;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.SeekBar;
import android.widget.TextView;
import android.widget.Toast;

import java.io.IOException;
import java.io.InputStream;
import java.io.OutputStream;
import java.net.Socket;
import java.util.TimerTask;

public class musicplayer extends AppCompatActivity
{
    Socket socket;
    OutputStream out;
    InputStream in;

    @Override
    protected void onCreate(Bundle savedInstanceState)
    {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_musicplayer);

        //writing port no. into textview
        TextView text = (TextView) findViewById(R.id.textView4);
        String portString = String.valueOf(MySingleton.port);
        text.setText(portString);
        ConnectionThread extraThread = new ConnectionThread();
        extraThread.start();
    }

    public void searchSong(View view)
    {
        TextView textview = (TextView) findViewById(R.id.editText6);
        String song = textview.getText().toString();

        try
        {
            out.write(song.getBytes());
            out.flush();
        }
        catch (Exception e)
        {
            Context context = getApplicationContext();
            CharSequence error = e.toString();
            int duration = Toast.LENGTH_SHORT;

            Toast toast = Toast.makeText(context, error, duration);
            toast.show();
        }

    }
    public void playSong(View view)
    {
        try
        {
            out.write("resume".getBytes());
            out.flush();
        }
        catch (Exception e)
        {
            Context context = getApplicationContext();
            CharSequence error = e.toString();
            int duration = Toast.LENGTH_SHORT;

            Toast toast = Toast.makeText(context, error, duration);
            toast.show();
        }
    }
    public void pauseSong(View view)
    {
        try
        {
            out.write("pause".getBytes());
            out.flush();
        }
        catch (Exception e)
        {
            Context context = getApplicationContext();
            CharSequence error = e.toString();
            int duration = Toast.LENGTH_SHORT;

            Toast toast = Toast.makeText(context, error, duration);
            toast.show();
        }
    }


    public class socketSendAndReceive extends TimerTask
    {
        public void run()
        {
            try
            {
                out.write("time".getBytes());
                out.flush();

                byte [] timeData = new byte [3];
                int time = in.read(timeData);

                out.write("state".getBytes());
                out.flush();

                byte [] stateData = new byte[1];
                int state = in.read(stateData);

                out.write("url".getBytes());
                out.flush();

                byte [] urlSizeData = new byte [1];
                int urlSize = in.read(urlSizeData);

                byte [] urlData = new byte[urlSize];
                int url = in.read(urlData);
            }
            catch (Exception e)
            {
                Context context = getApplicationContext();
                CharSequence error = e.toString();
                int duration = Toast.LENGTH_SHORT;

                Toast toast = Toast.makeText(context, error, duration);
                toast.show();
            }
        }
    }


    public class ConnectionThread extends Thread
    {

        @Override
        public void run()
        {

            // thread code here
            try
            {
                //connect to server
                socket = new Socket("18.191.35.199", MySingleton.port);

                //output stream: sending a message
                out = socket.getOutputStream();

                //input stream: receiving a message
                in = socket.getInputStream();

                Context context = getApplicationContext();
                CharSequence error = "Connected";
                int duration = Toast.LENGTH_SHORT;

                Toast toast = Toast.makeText(context, error, duration);
                toast.show();

            }
            catch(Exception e)
            {
                Context context = getApplicationContext();
                CharSequence error = e.toString();
                int duration = Toast.LENGTH_SHORT;

                Toast toast = Toast.makeText(context, error, duration);
                toast.show();
            }

        }

    }

    /*public void onProgressChanged (SeekBar seekBar, int progresValue, boolean fromUser)
    {

    }               //idkkkkkkkkkkkkkkk
    */


}
