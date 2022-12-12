package com.project.attendance;
import android.content.Intent;
import android.os.Bundle;
import android.view.Window;
import android.view.WindowManager;

import androidx.appcompat.app.AppCompatActivity;

import com.project.attendance.utils.Session;
import com.loopj.android.http.RequestParams;

public class Splash extends AppCompatActivity {
    private Session session;
    RequestParams params = new RequestParams();
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        this.requestWindowFeature(Window.FEATURE_NO_TITLE);
        getWindow().setFlags(WindowManager.LayoutParams.FLAG_FULLSCREEN, WindowManager.LayoutParams.FLAG_FULLSCREEN);
        setContentView(R.layout.splash);
        Thread timerThread = new Thread(){
            public void run(){
                try{
                    sleep(1000);
                }catch(InterruptedException e){
                    e.printStackTrace();
                }finally{
                    session = new Session(getApplicationContext());
                    if(session.isLoggedIn()) {
                        Intent intent = new Intent(Splash.this, Main.class);
                        startActivity(intent);
                        finish();
                    }else{
                        Intent intent = new Intent(Splash.this, SignIn.class);
                        startActivity(intent);
                        finish();
                    }
                }
            }
        };
        timerThread.start();
    }
}