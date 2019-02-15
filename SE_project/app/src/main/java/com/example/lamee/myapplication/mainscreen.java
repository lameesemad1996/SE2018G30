package com.example.lamee.myapplication;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;

public class mainscreen extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_mainscreen);
    }

    public void createRoom(View view)
    {
        Intent i = new Intent(this, musicplayer.class);
        startActivity(i);
    }
    public void joinRoom(View view)
    {
        Intent i = new Intent(this, musicplayer.class);
        startActivity(i);
    }

    public void profile(View view)
    {
        Intent i = new Intent(this, profile.class);
        startActivity(i);
    }
}
