package com.example.lamee.myapplication;

import android.content.Context;
import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Toast;

import com.android.volley.Response;
import com.android.volley.VolleyError;

import static java.util.logging.Logger.global;

public class mainscreen extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_mainscreen);
    }

    public void createRoom(View view)
    {
        final Intent i = new Intent(this, musicplayer.class);
        String url = "/create_room";
        Requests.sendRequest(url, this, new Response.Listener<String>()
                {
                    @Override
                    public void onResponse(String response)
                    {
                        MySingleton.port = Integer.valueOf(response);
                        startActivity(i);
                    }

                }, new Response.ErrorListener()
                {
                    @Override
                    public void onErrorResponse(VolleyError error)
                    {
                        Context context = getApplicationContext();
                        CharSequence text = error.toString();
                        int duration = Toast.LENGTH_SHORT;

                        Toast toast = Toast.makeText(context, text, duration);
                        toast.show();
                    }
                }
        );
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

