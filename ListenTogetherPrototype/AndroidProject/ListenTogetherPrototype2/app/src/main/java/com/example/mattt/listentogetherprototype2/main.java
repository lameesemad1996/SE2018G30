package com.example.mattt.listentogetherprototype2;

import android.content.DialogInterface;
import android.media.AudioManager;
import android.media.MediaPlayer;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.Toast;

import java.io.IOException;

public class main extends AppCompatActivity
{
    MediaPlayer mediaPlayer;
    Button playButton;
    Button stopButton;
    String url = "https://r2---sn-vg5obxxb-j5pl.googlevideo.com/videoplayback?ipbits=0&ei=P1L7W7xowfTGAu_tmuAL&pl=15&source=youtube&txp=5511222&c=WEB&gir=yes&clen=3528888&id=o-AHzeGKhYgK_FuNDOa7o-TBAZY323I9l2mO5N8HN0Y70p&expire=1543218847&fvip=5&key=cms1&mime=audio%2Fwebm&sparams=clen,dur,ei,expire,gir,id,ip,ipbits,ipbypass,itag,keepalive,lmt,mime,mip,mm,mn,ms,mv,pl,requiressl,source&keepalive=yes&lmt=1540222164330114&dur=216.561&itag=251&requiressl=yes&ip=2a03%3Ab0c0%3A1%3Ad0%3A%3A114%3Ad001&signature=6812FAE48E17D13360FECDD260541DBB38737BDD.78CACF4F23B0C804490CE34BD8D5B4A7C3234609&ratebypass=yes&redirect_counter=1&rm=sn-aigesl76&fexp=23763603&req_id=33b9b86fe9b4a3ee&cms_redirect=yes&ipbypass=yes&mip=154.130.11.123&mm=31&mn=sn-vg5obxxb-j5pl&ms=au&mt=1543197083&mv=m";

    @Override
    protected void onCreate(Bundle savedInstanceState)
    {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        playButton = findViewById(R.id.play);
        stopButton = findViewById(R.id.stop);

        playButton.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v) {
                mediaPlayer = new MediaPlayer();
                mediaPlayer.setAudioStreamType(AudioManager.STREAM_MUSIC);
                try {
                    mediaPlayer.setDataSource(url);
                } catch (IllegalArgumentException e) {
                    Toast.makeText(getApplicationContext(), "You might not set the URI correctly!", Toast.LENGTH_LONG).show();
                } catch (SecurityException e) {
                    Toast.makeText(getApplicationContext(), "You might not set the URI correctly!", Toast.LENGTH_LONG).show();
                } catch (IllegalStateException e) {
                    Toast.makeText(getApplicationContext(), "You might not set the URI correctly!", Toast.LENGTH_LONG).show();
                } catch (IOException e) {
                    e.printStackTrace();
                }
                try {
                    mediaPlayer.prepare();
                } catch (IllegalStateException e) {
                    Toast.makeText(getApplicationContext(), "You might not set the URI correctly!", Toast.LENGTH_LONG).show();
                } catch (IOException e) {
                    Toast.makeText(getApplicationContext(), "You might not set the URI correctly!", Toast.LENGTH_LONG).show();
                }
                mediaPlayer.start();
            }
        });

        stopButton =  findViewById(R.id.stop);
        stopButton.setOnClickListener(new View.OnClickListener() {

            public void onClick(View v)
            {
                if(mediaPlayer!=null && mediaPlayer.isPlaying()){
                    mediaPlayer.stop();
                }
            }
        });

    }



}
