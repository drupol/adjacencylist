# API Platform / Doctrine / Adjacency list

An adjacency list is a way to store a tree data structure using a table having
2 columns.

This tree containing nodes:

```
root
  node1
  node2
    node2.1
    node2.2
  node3
    node3.1
```

Could be stored in a table as such:

| id      | parent |
|---------|--------|
| root    | null   |
| node1   | root   |
| node2   | root   |
| node2.1 | node2  |
| node2.2 | node2  |
| node3   | root   |
| node3.1 | node3  |

The SQL structure of that table would be:

```sql
CREATE TABLE adjacency_list (
  id INT AUTO_INCREMENT NOT NULL,
  parent_id INT DEFAULT NULL,
  INDEX IDX_FDE5D6BF727ACA70 (parent_id),
  PRIMARY KEY(id)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB

ALTER TABLE adjacency_list
  ADD
    CONSTRAINT FK_FDE5D6BF727ACA70
    FOREIGN KEY (parent_id)
    REFERENCES adjacency_list (id)
```

Then, another table can be created that would contains the metadata of each node.

| id | nodeId  | firstname | lastname |
|----|---------|-----------|----------|
| 1  | root    | A         | B        |
| 2  | node1   | C         | D        |
| 3  | node2   | E         | F        |
| 4  | node2.1 | G         | H        |
| 5  | node2.2 | I         | J        |
| 6  | node3   | K         | L        |
| 7  | node3.1 | M         | N        |

The structure would be:

```sql
CREATE TABLE adjacency_list_item (
  id INT AUTO_INCREMENT NOT NULL,
  nodeId INT DEFAULT NOT NULL,
  firstname VARCHAR(255) NOT NULL,
  lastname VARCHAR(255) NOT NULL,
  UNIQUE INDEX UNIQ_DDADA13E126F525E (nodeId),
 PRIMARY KEY(id)
) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB

ALTER TABLE adjacency_list_item
 ADD
   CONSTRAINT FK_DDADA13E126F525E
   FOREIGN KEY (nodeId) 
   REFERENCES adjacency_list (id)
```

In order to get started with this, do:

* Run: `composer install`
* Update the `.env` file and set the URL to your database
* Run: `./bin/console doctrine:database:create`
* Run: `./bin/console doctrine:schema:update --force --complete --dump-sql`

To generate the fixtures in the database, do:

* Run: `./bin/console hautelook:fixtures:load`
