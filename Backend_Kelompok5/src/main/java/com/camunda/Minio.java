package com.camunda;

import io.minio.BucketExistsArgs;
import io.minio.MakeBucketArgs;
import io.minio.MinioClient;
import io.minio.UploadObjectArgs;
import io.minio.errors.*;

import java.io.IOException;
import java.io.InputStream;
import java.net.URL;
import java.nio.file.Files;
import java.nio.file.Path;
import java.nio.file.StandardCopyOption;
import java.security.InvalidKeyException;
import java.security.NoSuchAlgorithmException;

public class Minio {
    public Minio(String bukti) throws Exception {
        String accessKey = "javan";
        String secretKey = "asdf1234";

        MinioClient minioClient = MinioClient.builder().endpoint("minio.cloud.javan.co.id")
                .credentials(accessKey, secretKey).build();

        boolean isExist = minioClient
                .bucketExists(BucketExistsArgs.builder().bucket("kelompok-5-camunda-2").build());
        if (isExist) {
            System.out.println("Bucket already exists.");
        }
        else {
            minioClient.makeBucket(MakeBucketArgs.builder().bucket("kelompok-5-camunda-2").build());
        }

        minioClient.listBuckets().forEach(b -> System.out.println(b.name()));

        URL url = new URL(
                "edit_url.jpg");
        Path tempFile = Files.createTempFile(bukti, ".jpg");
        try (InputStream in = url.openStream()) {
            Files.copy(in, tempFile, StandardCopyOption.REPLACE_EXISTING);
        }

        UploadObjectArgs.Builder builder = UploadObjectArgs.builder().bucket("kelompok-5-camunda-2")
                .object(bukti+".jpg").filename(tempFile.toString());
        minioClient.uploadObject(builder.build());
    }
}
