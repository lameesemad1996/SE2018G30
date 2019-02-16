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
    public StatusUpdate(Context context)
    {
        c = context;
    }
    public void run()
    {
        String url = "/update_status";
        RequestQueue queue = MySingleton.getInstance(c).getRequestQueue();
        StringRequest stringRequest = new StringRequest(Request.Method.GET, url,
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
