// This is a sample model to get you started.

/**
 * A sample data source using local sqlite db.
 */
datasource db {
    provider = 'mysql'
    url      = env("DATABASE_URL")
}

generator client {
    provider = "prisma-client-js"
}

plugin openapi {
    provider = "@zenstackhq/openapi"
    output = "openapi.yaml"
    title = "API specs"
    version = "1.0.0"
    prefix = "/api/model"
}

/**
 * User model
 */
model User {
    id       String @id @default(cuid())
    email    String @unique @email @length(6, 32)
    password String @password @omit
    posts    Post[]

    // everybody can signup
    @@allow('create', true)

    // full access by self
    // @@allow('all', auth() == this)
    @@allow('all', true == true)
}

/**
 * Post model
 */
model Post {
    id        String   @id @default(cuid())
    createdAt DateTime @default(now())
    updatedAt DateTime @updatedAt
    title     String   @length(1, 256)
    content   String
    published Boolean  @default(false)
    author    User     @relation(fields: [authorId], references: [id])
    authorId  String

    // allow read for all signin users
    @@allow('read', auth() != null && published)

    // full access by author
    // @@allow('all', author == auth())
    @@allow('all', true == true)
}