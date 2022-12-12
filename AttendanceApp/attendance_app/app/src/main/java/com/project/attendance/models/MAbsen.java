package com.project.attendance.models;

public class MAbsen {
    private String id;
    private String tanggal;
    private String lokasi;
    private String checkin;
    private String checkout;

    public MAbsen() {}

    public MAbsen(String id, String tanggal, String lokasi, String checkin, String checkout) {
        this.id = id;
        this.tanggal = tanggal;
        this.lokasi = lokasi;
        this.checkin = checkin;
        this.checkout = checkout;
    }
    public String getId() {
        return id;
    }

    public void setId(String id) {
        this.id = id;
    }

    public String getTanggal() {
        return tanggal;
    }

    public void setTanggal(String tanggal) {
        this.tanggal = tanggal;
    }

    public String getLokasi() {
        return lokasi;
    }

    public void setLokasi(String lokasi) {
        this.lokasi = lokasi;
    }

    public String getCheckIn() {
        return checkin;
    }

    public void setCheckIn(String checkin) {
        this.checkin = checkin;
    }

    public String getCheckOut() {
        return checkout;
    }

    public void setCheckOut(String checkout) {
        this.checkout = checkout;
    }

}