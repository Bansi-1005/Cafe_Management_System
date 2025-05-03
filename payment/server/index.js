const express = require('express');
const cors = require('cors');
const stripe = require('stripe')('sk_test_51RDiJ2DAkvcIWVQCHmhepqFKMMYVtz7baGaf4gpmG7wnGPDSHzaPugHUOs0qwvGyDeEIfJSinyQi4x17cAKiu8Ld0094QImCqY');

const app = express();

app.use(cors());
app.use(express.json());

app.post('/payment', async (req, res) => {
    try {
        const { amount, email, itemName, quantity } = req.body;

        const product = await stripe.products.create({
            name: itemName || "Cafe Order",
        });

        const price = await stripe.prices.create({
            product: product.id,
            unit_amount: parseInt(amount) * 100, // convert INR to paise
            currency: 'inr',
        });

        const session = await stripe.checkout.sessions.create({
            line_items: [
                {
                    price: price.id,
                    quantity: quantity || 1,
                },
            ],
            mode: 'payment',
            success_url: `http://localhost/cafe_management_system/partial/_manageCart.php?status=success&amount=${amount}&address=${encodeURIComponent(req.body.address)}&address1=${encodeURIComponent(req.body.address1)}&phone=${encodeURIComponent(req.body.phone)}&zipcode=${req.body.zipcode}`,
            cancel_url: 'http://localhost/cafe_management_system/viewCart.php?status=cancel',
        });

        res.json({ url: session.url });
    } catch (error) {
        console.error('Error creating payment session:', error);
        res.status(500).json({ error: 'Internal Server Error' });
    }
});

app.listen(3000, () => {
    console.log('Server running on port 3000');
});
