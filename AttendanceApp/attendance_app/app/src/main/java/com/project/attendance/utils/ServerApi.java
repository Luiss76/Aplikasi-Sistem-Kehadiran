package com.project.attendance.utils;
public class ServerApi {
    public static String SERVER_URL         = "http://192.168.1.7/attendance/Api/";
    public static String SIGNIN             = SERVER_URL + "Auth/index";
    public static String AKUN               = SERVER_URL + "Akun/index";
    public static String AKUN_UPDATE        = SERVER_URL + "Akun/submit";
    public static String ABSENSI            = SERVER_URL + "Absensi/index";
    public static String ABSENIN            = SERVER_URL + "Absensi/absenIn";
    public static String ABSENOUT           = SERVER_URL + "Absensi/absenOut";
    public static String MAP                = SERVER_URL + "Absensi/map";
}
