package com.project.attendance;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;
import androidx.appcompat.app.AppCompatActivity;
import com.project.attendance.utils.Session;
import com.loopj.android.http.AsyncHttpClient;
import com.loopj.android.http.AsyncHttpResponseHandler;
import org.json.JSONException;
import org.json.JSONObject;

import static com.project.attendance.utils.ServerApi.SIGNIN;
import static com.project.attendance.utils.Tools.params;
public class SignIn extends AppCompatActivity {
    private Button mButtonSignIn;
    private EditText mTextUsername, mTextPassword;
    private ProgressDialog progressDialog;
    Session session;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        session = new Session(getApplicationContext());
        setContentView(R.layout.signin);
        mTextUsername = (EditText) findViewById(R.id.signin_username);
        mTextPassword = (EditText) findViewById(R.id.signin_password);
        mButtonSignIn = (Button) findViewById(R.id.signin_submit);
        buttonInit();
    }

    private void buttonInit() {
        mButtonSignIn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if(validate()){
                    loginUser();
                }
            }
        });
    }

    public void loginUser() {
        String username = mTextUsername.getText().toString();
        String password = mTextPassword.getText().toString();
        progressDialog = new ProgressDialog(SignIn.this, R.style.Theme_AppCompat_Dialog);
        progressDialog.setIndeterminate(true);
        progressDialog.setMessage("Login...");
        progressDialog.show();
        params.put("username", username);
        params.put("password", password);
        AsyncHttpClient client = new AsyncHttpClient();
        client.post(SIGNIN, params, new AsyncHttpResponseHandler() {
            @Override
            public void onSuccess(String response) {
                progressDialog.dismiss();
                try {
                    JSONObject obj = new JSONObject(response);
                    final String userid = obj.isNull("userid") ? null : obj.getString("userid");
                    final String nama = obj.isNull("nama") ? null : obj.getString("nama");
                    final String telepon = obj.isNull("telepon") ? null : obj.getString("telepon");
                    final String email = obj.isNull("email") ? null : obj.getString("email");
                    final String username = obj.isNull("username") ? null : obj.getString("username");
                    final String foto = obj.isNull("foto") ? null : obj.getString("foto");
                    final String status = obj.isNull("status") ? null : obj.getString("status");
                    if(status.equals("sukses")) {
                        session.createLoginSession(userid,username,nama,telepon,email,foto);
                        Intent intent = new Intent(getApplicationContext(), Main.class);
                        startActivity(intent);
                        finish();
                    }else{
                        Toast.makeText(getApplicationContext(), " Invaid Username or password !", Toast.LENGTH_LONG).show();
                    }
                } catch (JSONException e) {
                    progressDialog.dismiss();
                    Log.e("ERRORAPP", "SIGNIN");
                    e.printStackTrace();
                    Toast.makeText(getApplicationContext(), ""+e, Toast.LENGTH_SHORT).show();
                }
            }

            @Override
            public void onFailure(int statusCode, Throwable error, String content) {
                progressDialog.dismiss();
                if (statusCode == 404) {
                    Toast.makeText(getApplicationContext(), "File you requested is not found !", Toast.LENGTH_LONG).show();
                } else if (statusCode == 500) {
                    Toast.makeText(getApplicationContext(), "Sorry, Server is trouble", Toast.LENGTH_LONG).show();
                } else {
                    Toast.makeText(getApplicationContext(), "Please, check your internet connection !", Toast.LENGTH_LONG).show();
                }
            }
        });
    }

    public boolean validate() {
        boolean valid = true;

        String username = mTextUsername.getText().toString();
        String password = mTextPassword.getText().toString();

        if (username.isEmpty()) {
            mTextUsername.setError("Input username !");
            valid = false;
        } else {
            mTextUsername.setError(null);
        }

        if (password.isEmpty()) {
            mTextPassword.setError("Input password !");
            valid = false;
        } else {
            mTextPassword.setError(null);
        }
        return valid;
    }
    @Override
    public void onBackPressed() {
        super.onBackPressed();
        finishAffinity();
    }
}
