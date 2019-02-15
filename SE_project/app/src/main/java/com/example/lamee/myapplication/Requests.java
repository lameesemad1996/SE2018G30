package com.example.lamee.myapplication;
import android.app.Activity;

import com.android.volley.*;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

public class Requests
{
    static String host = "127.0.0.1:5000";
    public static void sendRequest(String url, Activity activity, Response.Listener<String> onSuccess, Response.ErrorListener onFailure)
    {
        RequestQueue queue = Volley.newRequestQueue(activity);
        StringRequest stringRequest = new StringRequest(Request.Method.GET, host+url, onSuccess, onFailure);
        queue.add(stringRequest);
    }
}
