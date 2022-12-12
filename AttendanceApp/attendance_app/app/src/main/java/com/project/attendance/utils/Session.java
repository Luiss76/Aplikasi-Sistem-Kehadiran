package com.project.attendance.utils;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.content.SharedPreferences.Editor;

import com.project.attendance.Splash;

import java.util.HashMap;

public class Session {
    SharedPreferences pref;
    Editor editor;
    Context _context;
    int PRIVATE_MODE = 0;

    private static final String PREF_NAME   = "MyPref";
    private static final String IS_LOGIN    = "IsLoggedIn";
    public static final String KEY_USERID   = "userid";
    public static final String KEY_NAME     = "name";
    public static final String KEY_TELP     = "telp";
    public static final String KEY_EMAIL    = "email";
    public static final String KEY_USERNAME = "username";
    public static final String KEY_FOTO     = "foto";

    public Session(Context context){
        this._context = context;
        pref = _context.getSharedPreferences(PREF_NAME, PRIVATE_MODE);
        editor = pref.edit();
    }

    public void createLoginSession(String userid,String name,String telepon,String email,String username,String foto){
        editor.putBoolean(IS_LOGIN, true);
        editor.putString(KEY_USERID, userid);
        editor.putString(KEY_NAME, name);
        editor.putString(KEY_TELP, telepon);
        editor.putString(KEY_EMAIL, email);
        editor.putString(KEY_USERNAME, username);
        editor.putString(KEY_FOTO, foto);
        editor.commit();
    }

    public HashMap<String, String> getUserDetails(){
        HashMap<String, String> user = new HashMap<String, String>();
        user.put(KEY_USERID, pref.getString(KEY_USERID, null));
        user.put(KEY_NAME, pref.getString(KEY_NAME, null));
        user.put(KEY_TELP, pref.getString(KEY_TELP, null));
        user.put(KEY_EMAIL, pref.getString(KEY_EMAIL, null));
        user.put(KEY_USERNAME, pref.getString(KEY_USERNAME, null));
        user.put(KEY_FOTO, pref.getString(KEY_FOTO, null));
        return user;
    }

    public void logoutUser(){
        editor.clear();
        editor.commit();
        Intent i = new Intent(_context, Splash.class);
        i.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
        i.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
        _context.startActivity(i);
    }
    public boolean isLoggedIn(){
        return pref.getBoolean(IS_LOGIN, false);
    }


}
