package com.project.attendance.adapters;

import android.annotation.SuppressLint;
import android.content.Context;
import android.content.Intent;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.LinearLayout;
import android.widget.TextView;

import androidx.cardview.widget.CardView;

import com.bumptech.glide.request.RequestOptions;
import com.project.attendance.R;
import com.project.attendance.models.MAbsen;

import java.util.List;
import java.util.Objects;

public class AbsenAdapter extends BaseAdapter {

    private Context context;
    private int layout;
    private List<MAbsen> listData;
    private RequestOptions options;

    public AbsenAdapter(Context context, int layout, List<MAbsen> listData) {
        this.context = context;
        this.layout = layout;
        this.listData = listData;
        options = new RequestOptions().centerCrop().placeholder(R.drawable.loading).error(R.drawable.loading);

    }

    @Override
    public int getCount() {
        return listData.size();
    }

    @Override
    public Object getItem(int position) {
        return listData.get(position);
    }

    @Override
    public long getItemId(int position) {
        return position;
    }


    private class ViewHolder {
        private TextView  mTanggal;
        private TextView  mLokasi;
        private TextView  mCheckin;
        private TextView  mCheckout;
        private CardView cardview;
        private LinearLayout layout;
    }

    @SuppressLint("SetTextI18n")
    @Override
    public View getView(final int position, View view, ViewGroup viewGroup) {
        View row = view;
        AbsenAdapter.ViewHolder holder = new AbsenAdapter.ViewHolder();

        if (row == null) {
            LayoutInflater inflater = (LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
            row = Objects.requireNonNull(inflater).inflate(layout, null);
            holder.mTanggal = (TextView) row.findViewById(R.id.fragment_absen_cardview_tanggal);
            holder.mLokasi = (TextView) row.findViewById(R.id.fragment_absen_cardview_lokasi);
            holder.mCheckin = (TextView) row.findViewById(R.id.fragment_absen_cardview_checkin);
            holder.mCheckout = (TextView) row.findViewById(R.id.fragment_absen_cardview_checkout);
            holder.cardview = (CardView) row.findViewById(R.id.fragment_absen_cardview_card);
            holder.layout = (LinearLayout) row.findViewById(R.id.fragment_absen_cardview_layout);
            row.setTag(holder);
        } else {
            holder = (AbsenAdapter.ViewHolder) row.getTag();
        }

        final MAbsen data = listData.get(position);
        holder.mTanggal.setText(data.getTanggal());
        holder.mLokasi.setText(data.getLokasi());
        holder.mCheckin.setText(data.getCheckIn());
        holder.mCheckout.setText(data.getCheckOut());
        return row;
    }
}