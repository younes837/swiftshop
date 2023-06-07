@component('mail::message')
@if($commande->etat_id==2)<body style="font-family: Arial, sans-serif; margin: 0; padding: 20px; background-color: #f5f5f5;">
    <div style="max-width: 800px; margin: 0 auto; background-color: #fff; padding: 10px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); border-radius: 10px;">
        <h1 style="text-align: center; color: #333; margin-bottom: 30px;">Invoice</h1>
      <table>
        <thead>
          <tr>
            <td>
            <span style="font-weight: bold; color: #888;">Invoice Number:</span>
             <span>#INV0{{$commande->id}}</span> </td>
            <td style="">
            <span style="font-weight: bold; color: #888;">Date:</span>
            <span>{{$commande->date}}</span> </td>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td >
                <h2 style="font-size: 20px; color: #333; margin-bottom: 10px;">Customer Information</h2>
                <p style="margin: 0; line-height: 1.6; color: #555;">{{App\Models\User::find($commande->user_id)->name}}</p>
                <p style="margin: 0; line-height: 1.6; color: #555;">{{App\Models\ville::find(App\Models\User::find($commande->user_id)->ville_id)->name}}</p>
                <p style="margin: 0; line-height: 1.6; color: #555;">{{App\Models\User::find($commande->user_id)->adress}}</p>
                <p style="margin: 0; line-height: 1.6; color: #555;">Email: {{App\Models\User::find($commande->user_id)->email}}</p>
                <p style="margin: 0; line-height: 1.6; color: #555;">Phone: {{App\Models\User::find($commande->user_id)->phone}}</p>
                </td>               
             <td >
            </td>
         </tr>
        </tbody>
      </table>
        <table style="width: 100%; border-collapse: collapse; margin-bottom: 30px;">
            <tr>
                <th style="padding: 15px; border: 1px solid #ccc; text-align: left; background-color: #f0f0f0; color: #555; font-weight: bold;">Item</th>
                <th style="padding: 15px; border: 1px solid #ccc; text-align: left; background-color: #f0f0f0; color: #555; font-weight: bold;">Quantity</th>
                <th style="padding: 15px; border: 1px solid #ccc; text-align: left; background-color: #f0f0f0; color: #555; font-weight: bold;">Price</th>
                <th style="padding: 15px; border: 1px solid #ccc; text-align: left; background-color: #f0f0f0; color: #555; font-weight: bold;">Total</th>
            </tr> @foreach (App\Models\ligneCommande::where('commande_id',$commande->id)->get() as $item)              
            <tr>
                <td style="padding: 15px; border: 1px solid #ccc; text-align: left;">{{App\Models\Produit::find($item->produit_id)->libelle}}</td>            
                <td style="padding: 15px; border: 1px solid #ccc; text-align: left;">{{$item->quantite}}</td>
                <td style="padding: 15px; border: 1px solid #ccc; text-align: left;">${{App\Models\Produit::find($item->produit_id)->price}}</td>
                <td style="padding: 15px; border: 1px solid #ccc; text-align: left;">${{App\Models\Produit::find($item->produit_id)->price*$item->quantite}}</td>
            </tr>@endforeach
            <tr>
                <td colspan="4" style="padding: 15px; border: 1px solid #ccc; text-align: right; font-weight: bold;">Total:</td>
                <td style="padding: 15px; border: 1px solid #ccc; text-align: left;">${{$commande->total}}</td>
            </tr>
        </table>
        <div>
        <h2 style="font-size: 20px; color: #333; margin-bottom: 10px;">SwiftShop</h2>
        <p  style="margin: 0; line-height: 1.6; color: #555;">123 Street, City, State, ZIP</p>
        <p  style="margin: 0; line-height: 1.6; color: #555;">Email: swiftshop6@gmail.com</p>
        <p  style="margin: 0; line-height: 1.6; color: #555;">Phone: 123-456-7890</p>
           </div>    
    </div>
    </body>
@else<div style="text-align: center; padding: 20px;">
  <h1 style="color: red;">Command Rejected</h1>
  <p style="font-size: 18px;">Your command has been rejected.</p>
</div>@endif
@endcomponent




