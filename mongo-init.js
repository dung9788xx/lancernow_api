db.createUser(
    {
        user: "dung",
        pwd: "dung",
        roles: [
            {
                role: "readWrite",
                db: "learn1"
            }
        ]
    }
);
