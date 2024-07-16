function send_to_whatsapp()
{
    let name = document.getElementById('name').value;
    let email = document.getElementById('email').value;
    let pesan = document.getElementById('pesan').value;

    let text = `Halo, saya adalah ${name},
    email : ${email},    
    pesan : ${pesan}`;

    let encodedtext = encodeURIComponent(text);

    let admin_phone = 6282362052767;

    let url = `https://wa.me/${admin_phone}?text=${encodedtext}`;

    window.open(url), "_blank";
}

function testing(){
    console.log('coba dlu');
}

class Node
{
   constructor(product_id, product_name, product_pic, price)
    {
        this.next = null;

        this.product_id = product_id;
        this.product_name = product_name; 
        this.product_pic = product_pic;
        this.price = price;
        this.total = 1;
    }
}

class Cart_structure
{
    constructor()
    {
        this.head = null;
        this.size = 0;      
    }

    clearing()
    {
        this.head = null;
        localStorage('old_cart', null);
        return 1;
    }

    is_empty()
    {
        return this.size === 0;
    }

    _save()
    {
        // * pertama membuat data nya menjadi array terlebih dahulu
        let temp = [];
        
        let curr = this.head;

        while(curr)
        {
            temp.push({
                product_id : curr.product_id,
                product_name : curr.product_name,
                product_pic : curr.product_pic,
                price : curr.price,
                total : curr.total
            }); 
            curr = curr.next;
        }
        
        const cart_data = {
            head : temp,
            size : this.size
        }

        const data = JSON.stringify(cart_data);
        localStorage.setItem('old_cart', data);
    }


    _load()
    {

        let plain_datas = localStorage.getItem('old_cart');

        if(!plain_datas) return;

        let curr = JSON.parse(plain_datas);

        console.log(plain_datas);
        console.log(curr.head);
    
        let prev = null;

        curr.head.forEach( data => {
            const new_data = new Node(data.product_id, data.product_name, data.product_pic, data.price);
            new_data.total = data.total;

            if(!this.head)
            {
                this.head = new_data;
            }else{
                prev.next = new_data;
            }

            prev = new_data;
        });

        this.size = curr.size;

    }

    insert(product_id, product_name, product_pic, price) {
        const id = parseInt(product_id);
        const new_item = new Node(id, product_name, product_pic, price);
    
        if (this.is_empty()) {
            this.head = new_item;
            this.size++;
            this._save();
            return;
        }
    
        let curr = this.head;
        let found = false;
    
        while (curr) {
            if (curr.product_id === id) {
                curr.total++;
                found = true;
                break;
            }
            curr = curr.next;
        }
    
        if (!found) {
            curr = this.head;
            while (curr.next) {
                curr = curr.next;
            }
            curr.next = new_item;
            this.size++;
        }
    
        this._save();
    }
    
    


    decrease_product(product_id)
    {
        if (this.is_empty() || product_id < 1) return false;

        let curr = this.head;
        let prev = null;

        while (curr && curr.product_id !== product_id) {
            prev = curr;
            curr = curr.next;
        }

        if (!curr) return false;

        curr.total--;

        if (curr.total < 1) {
            if (prev) {
                prev.next = curr.next;
            } else {
                this.head = curr.next;
            }
            this.size--;
        }

        this._save();
        return true;
    }

    
    views()
    {
        let curr = this.head;
        while(curr)
        {
            console.log(curr.product_id, curr.price, curr.total);
            curr = curr.next;
        }
    }

    testing()
    {
        console.log('bisa')
    }

    get_total()
    {
        let curr = this.head;
        let total = 0;

        while(curr)
        {
            let price = curr.price * curr.total;
            total += price;
            curr = curr.next;
        }

        return total;
    }

    to_html_cart_table()
    {
        let curr = this.head;
  
        let ongkir = 10000;

        let html = `<li>
                    <span class="top__text">Product</span>
                    <span class="top__text__right">Total</span>
                </li>`;

        if(this.is_empty())
        {
            html += '<div> Tidak ada barang di dalam keranjang </div>';

            return html;
        }
        

        while(curr){
            
            html += `

                <li>${curr.total}x ${curr.product_name} <span> ${formating_price(curr.price)}</span></li>
            `;
            
           
            curr = curr.next;
        }

        
        if(this.get_total() >= 300000)
        {
            ongkir = 0;
        }

        html += `<li>
        <span class="top__text">Ongkir</span>
        <span class="top__text__right">${formating_price(ongkir)}</span>
        </li>`;


        return html;
    }

    to_html()
    {
        let curr = this.head;
        let html = '';
        let ongkir = 10000

        if(this.is_empty())
        {
            html = '<div> Tidak ada barang di dalam keranjang </div>';
            console.log(html);
            return html;
        }
        

        while(curr){

            html += `
                  <tr>
                    <td class="cart__product__item">
                        <div class="cart__product__item__title mid">
                            <img src="${curr.product_pic}" alt="" width="75px">
                            <h6>${curr.product_name}</h6>
                        </div>
                    </td>
                    <td class="cart__price"> ${formating_price(curr.price)}</td>
                    <td class="cart__quantity mid">
                        <div class="pro-qty pisahkan" width="75px" style="display:flex; justify-content : space-between; align-items:center; ">
                            <button class="mrgin" onclick="insert(${curr.product_id}, '${curr.product_name}', '${curr.product_pic}', ${curr.price})">+</button><span width="50px">${curr.total}</span><button class="mrgin" onclick="deleting(${curr.product_id})"> - </button>
                        </div>
                    </td>
                    <td class="cart__total"> ${formating_price(curr.price * curr.total)}</td>
                </tr>
            `;

            curr = curr.next;
        }

        return html;
    }

    to_wa()
    {
        let curr =this.head;

        if(this.is_empty()){
            var toastElement = document.createElement('div');
            toastElement.classList.add('toast');
            toastElement.setAttribute('role', 'alert');
            toastElement.setAttribute('aria-live', 'assertive');
            toastElement.setAttribute('aria-atomic', 'true');
            toastElement.setAttribute('style', 'min-width="350px"');
        
        
            toastElement.innerHTML = `
                <div class="toast-header">
                    <strong class="mr-auto">Cart Kosong</strong>
                    <button type="button" class="ml-4 mb-3 close" data-dismiss="toast" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="toast-body">
                    Minimal terdapat 1 produk pada cart
                </div>
            `;
        
            document.getElementById('toast_container').appendChild(toastElement);
        
            $(toastElement).toast({
                delay: 3000
            })
            $(toastElement).toast('show');

            return false;
        }

        console.log('masih bisa')

        let nama = document.getElementById('nama_penerima').value;
        
        let no_hp = document.getElementById('no_hp_penerima').value;
        
        let alamat = document.getElementById('address').value;
        
        let metode_pembayaran = document.getElementById('pembayaran').value;
        let total = 0;
        let note = document.getElementById('note').value ? document.getElementById('note').value : '-';

        let ongkir = 10000;

        let text = 
        `[Pesanan Baru]\nHalo, Admin!\nSaya ingin memesan produk skincare dari website Anda dengan detail berikut:\n\nNama Lengkap: ${nama}\nNomor Telepon: ${no_hp}\nAlamat pengiriman: ${alamat}\n\nList Detail Pesanan:
        `;
        
        while(curr)
        {
            text +=
            `\n\nNama Produk: ${curr.product_name}\nJumlah: ${curr.total}\nHarga: ${formating_price(curr.total * curr.price)}`;

            total = total + curr.price * curr.total;
            curr = curr.next;
        }
        

        if(total >= 300000)
        {
            text += `Selamat untuk pembelian di atas Rp 300.000,00- mendapatkan bonus gratis ongkir`
            ongkir = 0   
        }
        
        text +=  `\n\nMetode pembayaran: ${metode_pembayaran}\nCatatan Tambahan: ${note}\n\Sub Harga: ${formating_price(total)}\nOngkir = ${ongkir}\nTotal Harga = ${total + ongkir}\n\nTerima kasih!`;
        
        let encodedtext = encodeURIComponent(text);
        let admin_phone = 6282362052767;

        let url = `https://wa.me/${admin_phone}?text=${encodedtext}`

        window.open(url, '_blank');+
       
    }

 }

let cart;

function load()
{
    cart = new Cart_structure();
    cart._load();    
    cart.testing();
    refreshing_cart();
}

function refreshing_cart()
{
    try{
    document.getElementById('cart_container').innerHTML = '';
    document.getElementById('cart_container').innerHTML = muncul();

    document.getElementById('daftar_cart').innerHTML = '';
    document.getElementById('daftar_cart').innerHTML = cart.to_html_cart_table()

    document.getElementById('total').innerHTML = '';
    document.getElementById('total').innerHTML = formating_price(cart.get_total());
    }catch(error)
    {
        console.log('bukan halaman cart', error);
    }
}

function muncul()
{
    return cart.to_html();
}

function insert(id, product_name, product_pic, price)
{
    toast_muncul();
    cart.insert(id, product_name, product_pic, price);
    refreshing_cart();
}

function deleting(id)
{
    cart.decrease_product(id);
    refreshing_cart()
}

function views()
{
    cart.views();
}

function formating_price(price)
{
    return Intl.NumberFormat(undefined, {
        style : 'currency',
        currency : 'IDR'
    }).format(price);
 }

function formated_price(id, price)
{
    const new_price = formating_price(price);
    document.getElementById(id).innerHTML = new_price;
}

function clearing()
{
    cart.clearing();
}

// function get_data() {
//     fetch('/search?search=acn')
//         .then(response => {
//             if (!response.ok) {
//                 throw new Error('Network response was not ok ' + response.statusText);
//             }
//             return response.json();
//         })
//         .then(datas => {
//             datas.products.forEach(data => {
//                 console.log(data);
//         });
            
//         })
//         .catch(error => {
//             console.error('There has been a problem with your fetch operation:', error);
//         });
// }


// get_data();

function toast_muncul()
{

    var toastElement = document.createElement('div');
    toastElement.classList.add('toast');
    toastElement.setAttribute('role', 'alert');
    toastElement.setAttribute('aria-live', 'assertive');
    toastElement.setAttribute('aria-atomic', 'true');
    toastElement.setAttribute('style', 'min-width="350px"');


    toastElement.innerHTML = `
        <div class="toast-header">
            <strong class="mr-auto">Menambahkan Produk</strong>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">
            Berhasil menambahkan 1 produk pada cart
        </div>
    `;

    document.getElementById('toast_container').appendChild(toastElement);

    $(toastElement).toast({
        delay: 3000
    })
    $(toastElement).toast('show');
}




