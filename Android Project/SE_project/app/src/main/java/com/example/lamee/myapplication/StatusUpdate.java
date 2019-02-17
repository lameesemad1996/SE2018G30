package com.example.lamee.myapplication;

import android.app.Activity;
import android.content.Context;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import java.util.TimerTask;

public class StatusUpdate extends TimerTask
{
    Context c;
    String username;
    public StatusUpdate(Context context, String usernameIN)
    {
        c = context;
        username = usernameIN;
    }
    public void run()
    {
        String url = "/update_status?username="+username;
        RequestQueue queue = MySingleton.getInstance(c).getRequestQueue();
        StringRequest stringRequest = new StringRequest(Request.Method.GET, Requests.host+url,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {

                    }
                }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error)
            {

            }
        });

        MySingleton.getInstance(c).addToRequestQueue(stringRequest);

    }
}
