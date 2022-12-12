package com.project.attendance.fragments;

import android.annotation.SuppressLint;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.ListView;
import android.widget.Toast;

import androidx.fragment.app.Fragment;
import androidx.swiperefreshlayout.widget.SwipeRefreshLayout;

import com.project.attendance.R;
import com.project.attendance.adapters.AbsenAdapter;
import com.project.attendance.models.MAbsen;
import com.project.attendance.utils.ServerApi;
import com.loopj.android.http.AsyncHttpClient;
import com.loopj.android.http.AsyncHttpResponseHandler;
import com.loopj.android.http.RequestParams;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;

public class AbsenFragment extends Fragment {
    private ListView listview;
    private SwipeRefreshLayout refreshLayout;
    private List<MAbsen> listData = new ArrayList<MAbsen>();
    private RequestParams params = new RequestParams();
    private String userid;
    static ImageView mStatus;

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        userid = this.getArguments().getString("userid");
        final View view = inflater.inflate(R.layout.fragment_absen, container, false);
        listview = (ListView) view.findViewById(R.id.fragment_absen_listview);
        mStatus = view.findViewById(R.id.fragment_absen_status);
        refreshLayout = (SwipeRefreshLayout) view.findViewById(R.id.fragment_absen_refresh);
        refreshLayout.setRefreshing(true);
        listData();
        refreshLayout.setOnRefreshListener(new SwipeRefreshLayout.OnRefreshListener() {
            @Override
            public void onRefresh() {
                listData();
                refreshLayout.setRefreshing(false);
            }
        });
        return view;
    }

    private void listData() {
        listData.clear();
        AsyncHttpClient client = new AsyncHttpClient();
        params.put("userid", userid);
        client.post(ServerApi.ABSENSI, params, new AsyncHttpResponseHandler() {
            @SuppressLint("ClickableViewAccessibility")
            @Override
            public void onSuccess(String response) {
                //Toast.makeText(getContext(), "response :"+response, Toast.LENGTH_LONG).show();
                try {
                    JSONArray arr = new JSONArray(response);
                    System.out.println(arr.length());
                    if (arr.length() != 0) {
                        for (int i = 0; i < arr.length(); i++) {
                            JSONObject obj = (JSONObject) arr.get(i);
                            MAbsen item = new MAbsen();
                            item.setId(obj.isNull("id") ? null : obj.getString("id"));
                            item.setTanggal(obj.isNull("tanggal") ? null : obj.getString("tanggal"));
                            item.setLokasi(obj.isNull("lokasi") ? null : obj.getString("lokasi"));
                            item.setCheckIn(obj.isNull("absen_in") ? null : obj.getString("absen_in"));
                            item.setCheckOut(obj.isNull("absen_out") ? null : obj.getString("absen_out"));
                            listData.add(item);
                        }
                    }
                } catch (JSONException e) {
                    e.printStackTrace();
                    refreshLayout.setRefreshing(false);
                } finally {
                    final AbsenAdapter adapter = new AbsenAdapter(getContext(), R.layout.fragment_absen_cardview, listData);
                    listview.setAdapter(adapter);
                    adapter.notifyDataSetChanged();
                    refreshLayout.setRefreshing(false);
                    if (listData.size() == 0){
                        mStatus.setVisibility(View.VISIBLE);
                    }else {
                        mStatus.setVisibility(View.GONE);
                    }
                }
            }
            @Override
            public void onFailure(int statusCode, Throwable error, String content) {
                if (statusCode == 404) {
                    Toast.makeText(getContext(), "File you requested is not found !", Toast.LENGTH_LONG).show();
                } else if (statusCode == 500) {
                    Toast.makeText(getContext(), "Sorry, Server is trouble", Toast.LENGTH_LONG).show();
                } else {
                    Toast.makeText(getContext(), "Please, check your internet connection !", Toast.LENGTH_LONG).show();
                }
            }
        });
    }
}