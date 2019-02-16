package com.example.lamee.myapplication;

import android.content.Context;
import android.content.Intent;
import android.graphics.Color;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;

import com.android.volley.RequestQueue;
import com.android.volley.toolbox.Volley;

import java.util.Timer;

public class MainActivity extends AppCompatActivity
{

    @Override
    protected void onCreate(Bundle savedInstanceState)
    {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        Timer timer = new Timer();
        timer.schedule(new StatusUpdate(getApplicationContext()), 0, 5000);
    }

    public void signIn(View view)
    {
        Intent i = new Intent(this, signIn.class);
        startActivity(i);
    }

    public void signUp(View view)
    {
        Intent i = new Intent (this, signUp.class);
        startActivity(i);
    }


}
