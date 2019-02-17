package com.example.lamee.myapplication;
import android.app.Activity;

import com.android.volley.*;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

public class Requests
{
    public static String host = "http://18.191.35.199";
    public static void sendRequest(String url, Activity activity, Response.Listener<String> onSuccess, Response.ErrorListener onFailure)
    {
        StringRequest stringRequest = new StringRequest(Request.Method.GET, (host+url) , onSuccess, onFailure);
        MySingleton.getInstance(activity).addToRequestQueue(stringRequest);
    }
}
