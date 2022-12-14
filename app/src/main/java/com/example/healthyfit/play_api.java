
package com.example.healthyfit;

import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;

import com.google.android.youtube.player.YouTubeBaseActivity;
import com.google.android.youtube.player.YouTubeInitializationResult;
import com.google.android.youtube.player.YouTubePlayer;
import com.google.android.youtube.player.YouTubePlayerView;

public class play_api extends YouTubeBaseActivity {
    private Intent intent;
    private int number;

    YouTubePlayerView playerView;
    YouTubePlayer player;

    private  static String API_KEY = ""; //개인 유튜브 API 입력
    private  static String videoId = "";

    private  static final String TAG = "player";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.player);

        intent = getIntent();
        number = intent.getIntExtra("number", -1);

        initPlayer();

        Button btnPlay = findViewById(R.id.youtubeBtn);
        btnPlay.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                playVideo();
            }
        });
    }

    private  void playVideo() {
        if(player != null) {
            if(player.isPlaying()) {
                player.pause();
            }
            //순서 별로 나오는 동영상이 다르도록 코딩
            switch(number) {
                case 0:
                    videoId = "ZSlp52IDzu0";
                    break;
                case 1 :
                    videoId = "HKNeUqlCsUc";
                    break;
                case 2:
                    videoId = "W4SpM2gxGdE";
                    break;
                case 3 :
                    videoId = "psgOw8HXUrQ";
                    break;
                case 4:
                    videoId = "cl5cc1_5zZc";
                    break;
            }
            player.cueVideo(videoId);
        }
    }



    private void initPlayer() {
        playerView = findViewById(R.id.youTubePlayerView);
        playerView.initialize(API_KEY, new YouTubePlayer.OnInitializedListener() {
            @Override
            public void onInitializationSuccess(YouTubePlayer.Provider provider, YouTubePlayer youTubePlayer, boolean b) {
                player = youTubePlayer;

                player.setPlayerStateChangeListener(new YouTubePlayer.PlayerStateChangeListener() {
                    @Override
                    public void onLoading() {

                    }

                    @Override
                    public void onLoaded(String id) {
                        Log.d(TAG, "onLoaded: " + id);
                        player.play();
                    }

                    @Override
                    public void onAdStarted() {

                    }

                    @Override
                    public void onVideoStarted() {

                    }

                    @Override
                    public void onVideoEnded() {

                    }

                    @Override
                    public void onError(YouTubePlayer.ErrorReason errorReason) {
                        Log.d(TAG, "onError: " + errorReason);
                    }
                });
            }

            @Override
            public void onInitializationFailure(YouTubePlayer.Provider provider, YouTubeInitializationResult youTubeInitializationResult) {

            }


        });
    }
}
