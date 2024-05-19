# BlazeDrive

## Group ltw13g03

- Tiago Pinheiro (up202207890) 33.3%
- André Teixeira (up202108882) 33.4%
- Tiago Rocha (up202206232) 33.3%

## Install Instructions

    git clone git@github.com:FEUP-LTW-2024/ltw-project-2024-ltw13g03.git
    git checkout final-delivery-v1
    cd database/
    sqlite3 store.db < store.sql
    cd ..
    php -S localhost:9000

## Screenshots

![image](https://github.com/FEUP-LTW-2024/ltw-project-2024-ltw13g03/assets/132365868/843b9dbb-dc3f-4b7b-bc47-e80d4d6751ab)

![image](https://github.com/FEUP-LTW-2024/ltw-project-2024-ltw13g03/assets/132365868/99683376-6491-4585-96ed-27fde2da39bf)

![image](https://github.com/FEUP-LTW-2024/ltw-project-2024-ltw13g03/assets/132365868/ff5af59e-2e73-4feb-9413-ce100278265f)


## Implemented Features

**General**:

- [x] Register a new account.
- [x] Log in and out.
- [x] Edit their profile, including their name, username, password, and email.

**Sellers**  should be able to:

- [x] List new items, providing details such as category, brand, model, size, and condition, along with images.
- [ ] Track and manage their listed items.
- [x] Respond to inquiries from buyers regarding their items and add further information if needed.
- [ ] Print shipping forms for items that have been sold.

**Buyers**  should be able to:

- [x] Browse items using filters like category, price, and condition.
- [x] Engage with sellers to ask questions or negotiate prices.
- [ ] Add items to a wishlist or shopping cart.
- [ ] Proceed to checkout with their shopping cart (simulate payment process).

**Admins**  should be able to:

- [x] Elevate a user to admin status.
- [x] Introduce new item categories, sizes, conditions, and other pertinent entities.
- [x] Oversee and ensure the smooth operation of the entire system.

**Security**:
We have been careful with the following security aspects:

- [ ] **SQL injection**
- [ ] **Cross-Site Scripting (XSS)**
- [ ] **Cross-Site Request Forgery (CSRF)**

**Password Storage Mechanism**: md5

**Aditional Requirements**:

We also implemented the following additional requirements (you can add more):

- [ ] **Rating and Review System**
- [ ] **Promotional Features**
- [ ] **Analytics Dashboard**
- [ ] **Multi-Currency Support**
- [ ] **Item Swapping**
- [ ] **API Integration**
- [ ] **Dynamic Promotions**
- [ ] **User Preferences**
- [ ] **Shipping Costs**
- [x] **Real-Time Messaging System**
