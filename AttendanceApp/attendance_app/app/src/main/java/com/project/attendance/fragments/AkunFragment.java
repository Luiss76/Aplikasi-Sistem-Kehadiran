package com.project.attendance.fragments;
import android.annotation.SuppressLint;
import android.app.AlertDialog;
import android.app.Dialog;
import android.app.ProgressDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.graphics.Color;
import android.net.Uri;
import android.os.Bundle;
import android.os.Environment;
import android.provider.MediaStore;
import android.util.Base64;
import android.view.Gravity;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.view.Window;
import android.view.WindowManager;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import androidx.appcompat.widget.AppCompatButton;
import androidx.fragment.app.Fragment;

import com.bumptech.glide.Glide;
import com.bumptech.glide.request.RequestOptions;
import com.project.attendance.R;
import com.project.attendance.utils.ServerApi;
import com.project.attendance.utils.Session;
import com.loopj.android.http.AsyncHttpClient;
import com.loopj.android.http.AsyncHttpResponseHandler;

import org.json.JSONException;
import org.json.JSONObject;

import java.io.ByteArrayInputStream;
import java.io.ByteArrayOutputStream;
import java.io.File;
import java.io.FileNotFoundException;
import java.io.FileOutputStream;
import java.io.IOException;
import java.util.Objects;

import static android.app.Activity.RESULT_OK;
import static com.project.attendance.utils.Tools.params;
public class AkunFragment extends Fragment {
    private String userid;
    private EditText mNama,mTelepon,mEmail,mUsername,mPassword,mPasswordConfirm;
    private Button mButtonUpdate;
    private ProgressDialog progressDialog;
    int PICK_IMAGE_CAMERA = 1;
    int PICK_IMAGE_GALLERY = 2;
    int bitmap_size = 60;
    Bitmap decoded;
    Bitmap bitmap;
    ImageView mFoto;
    String Stat="0";
    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container, Bundle savedInstanceState) {
        userid = this.getArguments().getString("userid");
        View view = inflater.inflate(R.layout.fragment_akun, container, false);
        mFoto = (ImageView) view.findViewById(R.id.fragment_akun_image);
        mUsername = (EditText) view.findViewById(R.id.fragment_akun_username);
        mNama = (EditText) view.findViewById(R.id.fragment_akun_nama);
        mEmail = (EditText) view.findViewById(R.id.fragment_akun_email);
        mTelepon = (EditText) view.findViewById(R.id.fragment_akun_telepon);
        mPassword = (EditText) view.findViewById(R.id.fragment_akun_password);
        mPasswordConfirm = (EditText) view.findViewById(R.id.fragment_akun_password_confirm);
        mButtonUpdate = (Button) view.findViewById(R.id.fragment_akun_update);
        getProfile();
        mFoto.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                selectImage();
            }
        });
        mButtonUpdate.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if(validate()){
                    UpdateSend();
                }
            }
        });
        return view;
    }

    private void getProfile() {
        params.put("userid", userid);
        AsyncHttpClient client = new AsyncHttpClient();
        client.post(ServerApi.AKUN, params, new AsyncHttpResponseHandler() {
            @SuppressLint({"ClickableViewAccessibility", "SetTextI18n"})
            @Override
            public void onSuccess(String response) {
               //Toast.makeText(getActivity(), "response :" +response, Toast.LENGTH_LONG).show();
                try {
                    JSONObject jsonObject = new JSONObject(response);
                    String username=jsonObject.isNull("username") ? null : jsonObject.getString("username");
                    String nama=jsonObject.isNull("nama") ? null : jsonObject.getString("nama");
                    String telepon=jsonObject.isNull("telepon") ? null : jsonObject.getString("telepon");
                    String email=jsonObject.isNull("email") ? null : jsonObject.getString("email");
                    String foto=jsonObject.isNull("foto") ? null : jsonObject.getString("foto");
                    mNama.setText(""+nama);
                    mUsername.setText(""+username);
                    mTelepon.setText(""+telepon);
                    mEmail.setText(""+email);
                    SetImage(foto);
                } catch (JSONException e) {
                    e.printStackTrace();
                }
            }

            @Override
            public void onFailure(int statusCode, Throwable error, String content) {
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
    private void SetImage(String foto){
        RequestOptions options = new RequestOptions().centerCrop().placeholder(R.drawable.loading).error(R.drawable.loading);
        Glide.with(this).load(foto).apply(options).into(mFoto);
    }
    private void UpdateSend() {
        String telepon = mTelepon.getText().toString();
        String email = mEmail.getText().toString();
        String password = mPassword.getText().toString();
        String foto = (Stat.equals("1")) ? getStringImage(decoded): "";

        progressDialog = new ProgressDialog(getActivity(), R.style.Theme_AppCompat_Dialog);
        progressDialog.setIndeterminate(true);
        progressDialog.setMessage("Proses...");
        progressDialog.show();

        params.put("userid", userid);
        params.put("telepon", telepon);
        params.put("email", email);
        params.put("password", password);
        params.put("foto", foto);
        AsyncHttpClient client = new AsyncHttpClient();
        client.post(ServerApi.AKUN_UPDATE, params, new AsyncHttpResponseHandler() {
            @SuppressLint("ClickableViewAccessibility")
            @Override
            public void onSuccess(String response) {
                //Toast.makeText(getActivity(), "REsponse "+response, Toast.LENGTH_SHORT).show();
                progressDialog.dismiss();
                try {
                    JSONObject obj = new JSONObject(response);
                    final String status = obj.isNull("status") ? null : obj.getString("status");
                    if (status.equals("sukses")) {
                        Toast.makeText(getActivity(), "Update profile sukses !", Toast.LENGTH_SHORT).show();
                        getProfile();
                    }else {
                        Toast.makeText(getActivity(), "Update profile, silahkan ulangi !", Toast.LENGTH_SHORT).show();
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
        String nama = mNama.getText().toString();
        String telepon = mTelepon.getText().toString();
        String email = mEmail.getText().toString();
        String usernmae = mUsername.getText().toString();
        String password = mPassword.getText().toString();
        String repassword = mPasswordConfirm.getText().toString();

        if (nama.isEmpty()) {
            mNama.setError("Nama Harus diisi ");
            valid = false;
        } else {
            mNama.setError(null);
        }
        if (telepon.isEmpty()) {
            mTelepon.setError("Telepon Harus diisi ");
            valid = false;
        } else {
            mTelepon.setError(null);
        }
        if (email.isEmpty() || !android.util.Patterns.EMAIL_ADDRESS.matcher(email).matches()) {
            mEmail.setError("Email harus valid");
            valid = false;
        } else {
            mEmail.setError(null);
        }
        if (usernmae.isEmpty()) {
            mUsername.setError("Username Harus diisi ");
            valid = false;
        } else {
            mUsername.setError(null);
        }
        if (password.isEmpty()) {
            mPassword.setError(null);
        } else {
            if(password.length() < 4 || password.length() > 10){
                mPassword.setError("panjang password 4 sampai 10 karakter");
                valid = false;
            }else{
                if (!password.equals(repassword)) {
                    mPasswordConfirm.setError("konfirmasi password harus sama");
                    valid = false;
                } else {
                    mPasswordConfirm.setError(null);
                }
            }
        }
        return valid;
    }

    private void selectImage() {
        final CharSequence[] items = { "Take Photo", "Choose from Library", "Cancel" };
        TextView title = new TextView(getActivity());
        title.setText("CHANGE PHOTO");
        title.setBackgroundColor(Color.BLACK);
        title.setPadding(10, 15, 15, 10);
        title.setGravity(Gravity.CENTER);
        title.setTextColor(Color.WHITE);
        title.setTextSize(22);
        AlertDialog.Builder builder = new AlertDialog.Builder(getActivity());
        builder.setCustomTitle(title);
        builder.setItems(items, new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialog, int item) {
                if (items[item].equals("Take Photo")) {
                    showCameraIntent();
                } else if (items[item].equals("Choose from Library")) {
                    showFileChooser();
                } else if (items[item].equals("Cancel")) {
                    dialog.dismiss();
                }
            }
        });
        builder.show();
    }

    private void showCameraIntent()
    {
        Intent intent = new Intent(MediaStore.ACTION_IMAGE_CAPTURE);
        startActivityForResult(intent, PICK_IMAGE_CAMERA);
    }

    private void showFileChooser() {
        Intent intent = new Intent();
        intent.setType("image/*");
        intent.setAction(Intent.ACTION_GET_CONTENT);
        startActivityForResult(Intent.createChooser(intent, "Select Picture"), PICK_IMAGE_GALLERY);
    }

    public void onActivityResult(int requestCode, int resultCode, Intent data) {
        super.onActivityResult(requestCode, resultCode, data);
        if (requestCode == PICK_IMAGE_GALLERY && resultCode == RESULT_OK && data != null && data.getData() != null) {
            onSelectFromGalleryResult(data);
        }else if (requestCode == PICK_IMAGE_CAMERA && resultCode == RESULT_OK) {
            onCaptureImageResult(data);
        }else{
            Toast.makeText(getActivity(), "Periksa Pengaturan !", Toast.LENGTH_LONG).show();
        }

    }
    private void onCaptureImageResult(Intent data) {
        bitmap = (Bitmap) data.getExtras().get("data");
        ByteArrayOutputStream bytes = new ByteArrayOutputStream();
        bitmap.compress(Bitmap.CompressFormat.JPEG, 90, bytes);
        File destination = new File(Environment.getExternalStorageDirectory(), System.currentTimeMillis() + ".jpg");
        FileOutputStream fo;
        try {
            destination.createNewFile();
            fo = new FileOutputStream(destination);
            fo.write(bytes.toByteArray());
            fo.close();
        } catch (FileNotFoundException e) {
            e.printStackTrace();
        } catch (IOException e) {
            e.printStackTrace();
        }
        setToImageView(getResizedBitmap(bitmap, 512));
    }

    private void onSelectFromGalleryResult(Intent data) {
        Uri filePath = data.getData();
        try {
            //mengambil fambar dari Gallery getActivity().
            //        applicationContext.getContentResolver();
            bitmap = MediaStore.Images.Media.getBitmap(getActivity().getContentResolver(), filePath);
            // 512 adalah resolusi tertinggi setelah image di resize, bisa di ganti.
            setToImageView(getResizedBitmap(bitmap, 512));

        } catch (IOException e) {
            e.printStackTrace();
        }
    }

    private void setToImageView(Bitmap bmp) {
        //compress image
        ByteArrayOutputStream bytes = new ByteArrayOutputStream();
        bmp.compress(Bitmap.CompressFormat.JPEG, bitmap_size, bytes);
        decoded = BitmapFactory.decodeStream(new ByteArrayInputStream(bytes.toByteArray()));
        mFoto.setImageBitmap(decoded);
        Stat="1";
    }

    public Bitmap getResizedBitmap(Bitmap image, int maxSize) {
        int width = image.getWidth();
        int height = image.getHeight();

        float bitmapRatio = (float) width / (float) height;
        if (bitmapRatio > 1) {
            width = maxSize;
            height = (int) (width / bitmapRatio);
        } else {
            height = maxSize;
            width = (int) (height * bitmapRatio);
        }
        return Bitmap.createScaledBitmap(image, width, height, true);
    }

    public String getStringImage(Bitmap bmp) {
        ByteArrayOutputStream baos = new ByteArrayOutputStream();
        bmp.compress(Bitmap.CompressFormat.JPEG, bitmap_size, baos);
        byte[] imageBytes = baos.toByteArray();
        String encodedImage = Base64.encodeToString(imageBytes, Base64.DEFAULT);
        return encodedImage;
    }
}