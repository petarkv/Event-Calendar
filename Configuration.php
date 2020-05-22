<?php
    final class Configuration {
        #const BASE = 'http://localhost/EventCalendar/';
        
        const DATABASE_HOST = 'localhost';
        const DATABASE_USER = 'root';
        const DATABASE_PASS = '';
        const DATABASE_NAME = 'event_calendar';

        const SESSION_STORAGE = '\\App\\Core\\Session\\FileSessionStorage';
        const SESSION_STORAGE_DATA = [ './sessions/' ];
        const SESSION_LIFETIME = 3600;

        const FINGERPRINT_PROVIDER_FACTORY = '\\App\\Core\\Fingerprint\\BasicFingerprintProviderFactory';
        const FINGERPRINT_PROVIDER_METHOD  = 'getInstance';
        const FINGERPRINT_PROVIDER_ARGS    = [ 'SERVER' ];

        const UPLOAD_DIR = './assets/uploads/';

        const DEFAULT_IMEGE_WIDTH = 320;
        const DEFAULT_IMAGE_HEIGHT = 240;

        const MAIL_HOST = 'smtp.mailtrap.io';
        const MAIL_PORT = '587';
        const MAIL_PROTOCOL = 'tls';
        const MAIL_USERNAME = 'e9f006d19253a0';
        const MAIL_PASSWORD = '6fbd590f6d6a14';
    }