package com.project.attendance.fragments;

import static com.project.attendance.utils.Tools.params;

import android.Manifest;
import android.annotation.SuppressLint;
import android.app.ProgressDialog;
import android.content.pm.PackageManager;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.graphics.Color;
import android.location.Location;
import android.location.LocationManager;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import androidx.core.app.ActivityCompat;
import androidx.fragment.app.Fragment;

import com.google.android.gms.location.LocationCallback;
import com.google.android.gms.location.LocationServices;
import com.google.android.gms.maps.model.BitmapDescriptorFactory;
import com.google.android.gms.maps.model.CircleOptions;
import com.google.android.gms.tasks.Task;
import com.loopj.android.http.AsyncHttpClient;
import com.loopj.android.http.AsyncHttpResponseHandler;
import com.project.attendance.R;

import com.google.android.gms.maps.CameraUpdateFactory;
import com.google.android.gms.maps.GoogleMap;
import com.google.android.gms.maps.OnMapReadyCallback;
import com.google.android.gms.maps.SupportMapFragment;
import com.google.android.gms.maps.model.LatLng;
import com.google.android.gms.maps.model.MarkerOptions;
import com.project.attendance.utils.ServerApi;

import org.json.JSONArray;
import org.json.JSONObject;
import org.json.JSONException;

public class MapFragment extends Fragment {
    private GoogleMap mMap;
    private LatLng posisi;
    private String userid;
    private String lat;
    private String lon;
    private Button btnIn;
    private Button btnOut;
    private Button btnReload;
    private String office=null;
    private String lokasi=null;
    private String latitude=null;
    private String longitude=null;
    private String tanggal=null;
    private String isabsen=null;
    private ProgressDialog progressDialog;
    float zoomLevel = 16.0f;
    LatLng latlon;

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Initialize view
        userid = this.getArguments().getString("userid");
        lat = this.getArguments().getString("latitude");
        lon = this.getArguments().getString("longitude");
        View view = inflater.inflate(R.layout.fragment_map, container, false);
        btnIn = (Button) view.findViewById(R.id.btnCheckIn);
        btnOut = (Button) view.findViewById(R.id.btnCheckOut);
        btnReload = (Button) view.findViewById(R.id.btnReload);
        posisi = new LatLng(-6.394879, 106.795493);
        if(lat!=null && lon!=null){
            posisi = new LatLng(Double.parseDouble(lat), Double.parseDouble(lon));
        }
        LatLng finalLokasi = posisi;
        SupportMapFragment supportMapFragment = (SupportMapFragment) getChildFragmentManager().findFragmentById(R.id.google_map);
        supportMapFragment.getMapAsync(new OnMapReadyCallback() {
            @SuppressLint("MissingPermission")
            @Override
            public void onMapReady(GoogleMap googleMap) {
                mMap = googleMap;
                mMap.moveCamera(CameraUpdateFactory.newLatLng(finalLokasi));
                mMap.addMarker(new MarkerOptions().position(finalLokasi).title("My Location").icon(BitmapDescriptorFactory.fromResource(R.drawable.ic_location_dot)));
                mMap.moveCamera(CameraUpdateFactory.newLatLngZoom(finalLokasi, zoomLevel));
                mMap.setMyLocationEnabled(true);
                getMarkers();
            }
        });
        btnReload.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                posisi = new LatLng(Double.parseDouble(lat), Double.parseDouble(lon));
                reload(posisi);
                getMarkers();
            }
        });

        btnIn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if(validate()) {
                    AbsenSend("in");
                }
            }
        });
        btnOut.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if(validate()) {
                    AbsenSend("out");
                }
            }
        });
        // Return view
        return view;
    }

    private void reload(LatLng point){
        mMap.animateCamera(CameraUpdateFactory.newLatLngZoom(point, zoomLevel));
    }

    private void AbsenSend(String type)
    {
        String url=ServerApi.ABSENIN;
        if(type.equals("out")){
            url=ServerApi.ABSENOUT;
        }
        progressDialog = new ProgressDialog(getActivity(), R.style.Theme_AppCompat_Dialog);
        progressDialog.setIndeterminate(true);
        progressDialog.setMessage("Proses...");
        progressDialog.show();

        params.put("userid", userid);
        params.put("lokasi", office);
        AsyncHttpClient client = new AsyncHttpClient();
        client.post(url, params, new AsyncHttpResponseHandler() {
            @SuppressLint("ClickableViewAccessibility")
            @Override
            public void onSuccess(String response) {
                //Toast.makeText(getContext(), "response "+response, Toast.LENGTH_LONG).show();
                progressDialog.dismiss();
                try {
                    JSONObject obj = new JSONObject(response);
                    final Boolean status = obj.isNull("status") ? null : obj.getBoolean("status");
                    final String message = obj.isNull("message") ? null : obj.getString("message");
                    if (status) {
                        Toast.makeText(getActivity(), message, Toast.LENGTH_SHORT).show();
                    }else {
                        Toast.makeText(getActivity(), message, Toast.LENGTH_SHORT).show();
                    }
                } catch (JSONException e) {
                    progressDialog.dismiss();
                    e.printStackTrace();
                    Toast.makeText(getActivity(), ""+e, Toast.LENGTH_SHORT).show();
                }
            }

            @Override
            public void onFailure(int statusCode, Throwable error, String content) {
                progressDialog.dismiss();
                if (statusCode == 404) {
                    Toast.makeText(getActivity(), "File you requested is not found !", Toast.LENGTH_LONG).show();
                } else if (statusCode == 500) {
                    Toast.makeText(getActivity(), "Sorry, Server is trouble", Toast.LENGTH_LONG).show();
                } else {
                    Toast.makeText(getActivity(), "Please, check your internet connection !", Toast.LENGTH_LONG).show();
                }
            }
        });
    }

    public boolean validate() {
        boolean valid = true;
        if (office==null || latitude==null || longitude==null) {
            Toast.makeText(getContext(), "Error, data belum lengkap !", Toast.LENGTH_LONG).show();
            valid = false;
        }
        return valid;
    }

    public void getMarkers() {
        AsyncHttpClient client = new AsyncHttpClient();
        params.put("userid", userid);
        client.post(ServerApi.MAP, params, new AsyncHttpResponseHandler() {
            @Override
            public void onSuccess(String response) {
                //Toast.makeText(getContext(), "response "+response, Toast.LENGTH_LONG).show();
                try {
                    JSONArray arr = new JSONArray(response);
                    System.out.println(arr.length());
                    if(arr.length() != 0) {
                        for (int i = 0; i < arr.length(); i++) {
                            JSONObject obj = (JSONObject) arr.get(i);
                            office = obj.isNull("id") ? null : obj.getString("id");
                            lokasi = obj.isNull("lokasi") ? null : obj.getString("lokasi");
                            latitude = obj.isNull("latitude") ? null : obj.getString("latitude");
                            longitude = obj.isNull("longitude") ? null : obj.getString("longitude");
                            tanggal = obj.isNull("tanggal") ? null : obj.getString("tanggal");
                            isabsen = obj.isNull("isabsen") ? null : obj.getString("isabsen");
                            try {
                                latlon = new LatLng(Double.parseDouble(latitude), Double.parseDouble(longitude));
                                drawCircle(latlon);
                                if(lat!=null && lon!=null) {
                                    distance(Double.parseDouble(lat), Double.parseDouble(lon), Double.parseDouble(latitude), Double.parseDouble(longitude));
                                }
                            } catch (NumberFormatException e) {
                                Toast.makeText(getContext(), "Error " + e, Toast.LENGTH_LONG).show();
                            }
                        }
                    }else{
                        Toast.makeText(getContext(), "Data tidak di temukan !", Toast.LENGTH_LONG).show();
                    }
                }
                catch (JSONException e)
                {
                    e.printStackTrace();
                }
            }

            @Override
            public void onFailure(int statusCode, Throwable error, String content) {

                if (statusCode == 404) {
                    Toast.makeText(getContext(), "File not found !", Toast.LENGTH_LONG).show();
                }else if (statusCode == 500) {
                    Toast.makeText(getContext(), "Server is trouble !", Toast.LENGTH_LONG).show();
                }else {
                    Toast.makeText(getContext(), "check your internet connection !", Toast.LENGTH_LONG).show();
                }
            }
        });
    }

    private void drawCircle(LatLng point){
        // Instantiating CircleOptions to draw a circle around the marker
        CircleOptions circleOptions = new CircleOptions();
        // Specifying the center of the circle
        circleOptions.center(point);
        // Radius of the circle
        circleOptions.radius(100);
        // Border color of the circle
        circleOptions.strokeColor(Color.RED);
        // Fill color of the circle
        circleOptions.fillColor(0x30ff0000);
        // Border width of the circle
        circleOptions.strokeWidth(2);
        // Adding the circle to the GoogleMap
        mMap.addCircle(circleOptions);
        mMap.animateCamera(CameraUpdateFactory.newLatLngZoom(point, zoomLevel));
    }

    private void distance(double lat1, double lon1, double lat2, double lon2) {
        final int R = 6371;
        double latDistance = Math.toRadians(lat2 - lat1);
        double lonDistance = Math.toRadians(lon2 - lon1);
        double a = Math.sin(latDistance / 2) * Math.sin(latDistance / 2) +
                Math.cos(Math.toRadians(lat1)) * Math.cos(Math.toRadians(lat2)) *
                        Math.sin(lonDistance / 2) * Math.sin(lonDistance / 2);
        double c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));

        double jarak=R * c * 1000;
        if(jarak<100){
            btnIn.setEnabled(true);
            btnOut.setEnabled(true);
        }else {
            btnIn.setEnabled(false);
            btnOut.setEnabled(false);
            Toast.makeText(getContext(), "Anda berada di luar Area !", Toast.LENGTH_LONG).show();
        }
    }
}