package com.example.lamee.myapplication;

import android.app.Activity;
import android.content.Context;
import android.content.Intent;
import android.os.SystemClock;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.Response;
import com.android.volley.VolleyError;

public class signUp extends AppCompatActivity
{
    private long mLastClickTime = 0;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_sign_up);
    }


    public void signUpInternal(View view)
    {
        if (SystemClock.elapsedRealtime() - mLastClickTime < 20000) {
            return;
        }
        mLastClickTime = SystemClock.elapsedRealtime();


        final Intent i = new Intent(this, mainscreen.class);

        TextView usernameText = (TextView) findViewById(R.id.editText2);
        String username = usernameText.getText().toString();
        TextView passwordText = (TextView) findViewById(R.id.editText4);
        String password = passwordText.getText().toString();
        TextView nicknameText = (TextView) findViewById(R.id.editText5);
        String nickname = nicknameText.getText().toString();
        TextView emailText = (TextView) findViewById(R.id.editText3);
        String email = nicknameText.getText().toString();

        String url1 = "/signup?username="+username+"&password="+password;
        final String url2 = "/fill_profile?"+"username="+username+"&nickname="+nickname+"&email="+email;

        //signining user up by sending username and password, get method
        final Activity activity = this;
        Requests.sendRequest(url1, this, new Response.Listener<String>()
                {
                    @Override
                    public void onResponse(String response)
                    {
                        if (response.equals("Success"))
                        {
                            Requests.sendRequest(url2, activity, new Response.Listener<String>()
                                    {
                                        @Override
                                        public void onResponse(String response)
                                        {
                                            if (response.equals("Profile filled"))
                                            {
                                                startActivity(i);
                                            }
                                            else
                                            {
                                                MySingleton.SignedUp = false;

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
                        else
                        {
                            MySingleton.SignedUp = false;

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
