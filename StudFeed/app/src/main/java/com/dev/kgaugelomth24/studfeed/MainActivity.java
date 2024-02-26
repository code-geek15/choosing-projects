package com.dev.kgaugelomth24.studfeed;

import androidx.appcompat.app.AppCompatActivity;

import android.animation.Animator;
import android.animation.AnimatorListenerAdapter;
import android.animation.ObjectAnimator;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.view.WindowManager;
import android.view.animation.DecelerateInterpolator;
import android.widget.ProgressBar;

public class MainActivity extends AppCompatActivity {

    private ProgressBar progressBar;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        getWindow().setFlags(WindowManager.LayoutParams.FLAG_FULLSCREEN, WindowManager.LayoutParams.FLAG_FULLSCREEN);
        setContentView(R.layout.activity_main);

      //progressbar
        progressBar = findViewById(R.id.progressBar);

        animateProgressBar(4000);

    }

    private void animateProgressBar(int duration) {
        ObjectAnimator animation = ObjectAnimator.ofInt(progressBar, "progress", 0, 100);
        animation.setDuration(duration);
        animation.setInterpolator(new DecelerateInterpolator());
        animation.start();

        // You can also listen for animation completion and start the next activity
        animation.addListener(new AnimatorListenerAdapter() {
            @Override
            public void onAnimationEnd(Animator animation) {
                // Animation completed, navigate to the next activity here
                navigateToNextActivity();
            }
        });
    }

    private void navigateToNextActivity() {
        // Start the next activity here
        Intent intent = new Intent(MainActivity.this, WebViewActivity.class);
        startActivity(intent);
        finish();
    }
}
