package com.example.lamee.myapplication;

import android.content.Context;
import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.*;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

public class signIn extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_sign_in);
    }

    public void signInInternal(View view)
    {
        final Intent i = new Intent(this, mainscreen.class);

        TextView usernameText = (TextView) findViewById(R.id.editText7);
        String username = usernameText.getText().toString();
        TextView passwordText = (TextView) findViewById(R.id.editText8);
        String password = passwordText.getText().toString();

        String url = "/login?username="+username+"&password="+password;

        Requests.sendRequest(url, this, new Response.Listener<String>()
                {
                    @Override
                    public void onResponse(String response)
                    {
                        if (response.equals("Welcome"))
                        {
                            startActivity(i);
                        }
                        else
                        {
                            Context context = getApplicationContext();
                            CharSequence text = response;
                            int duration = Toast.LENGTH_SHORT;

                            Toast toast = Toast.makeText(context, text, duration);
                            toast.show();
                        }
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
}
