CREATE TABLE IF NOT EXISTS aktor
(
    id          INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
    nickname    TEXT NOT NULL,
    description TEXT NOT NULL,
    video_url   TEXT NOT NULL DEFAULT ''
);