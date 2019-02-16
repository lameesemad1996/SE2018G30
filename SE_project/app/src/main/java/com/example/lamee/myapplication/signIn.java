package com.example.lamee.myapplication;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.TextView;
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
        Intent i = new Intent(this, mainscreen.class);
        startActivity(i);
        TextView usernameText = (TextView) findViewById(R.id.editText7);
        String username = usernameText.getText().toString();
        TextView passwordText = (TextView) findViewById(R.id.editText8);
        String password = passwordText.getText().toString();
        String url = "/signup?username="+username+"&password="+password;
       /* Requests.sendRequest(url, this, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {

            }
        },
                R);
                */
    }
}
