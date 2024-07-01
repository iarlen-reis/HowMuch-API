<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>HowMuch API</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Styles -->
    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/prism.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-json.min.js"></script>
</head>

<body>
    <d class="container px-3 mx-auto flex flex-col gap-3">
        <div class="mt-6 flex flex-col">
            <h1 class="text-3xl">HowMuch API</h1>
            <p>Version 1.0.0</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="https://github.com/iarlen-reis/HowMuch-API" target="_blank" rel="noreferrer" class="flex items-center gap-2 px-3 py-2 rounded-md border border-black/60 w-fit h-fit hover:text-white hover:bg-black/80 hover:border-white/60 transition-all">
                <i class="fa-brands fa-github text-xl"></i>
                <span class="text-sm">Github</span>
            </a>
            <a href="https://how-much.iarlenreis.com.br/" target="_blank" rel="noreferrer" class="flex items-center gap-2 px-3 py-2 rounded-md border border-black/60 w-fit h-fit hover:text-white hover:bg-red-600/80 hover:border-white/60 transition-all">
                <i class="fa-solid fa-rocket text-xl"></i>
                <span class="text-sm">Deploy</span>
            </a>
            <a href="/api/documentation" rel="noreferrer" class="flex items-center gap-2 px-3 py-2 rounded-md border border-black/60 w-fit h-fit hover:text-white hover:bg-green-600/80 hover:border-white/60 transition-all">
                <i class="fa-solid fa-file-lines text-xl"></i>
                <span class="text-sm">Swagger</span>
            </a>
        </div>
        <div>
            <pre>
      <code class="language-json">
{
    "data": {
    "total_current_invoice": "812.54",
    "total_next_invoices": "450.89",
    "last_purchases": [
        {
            "date": "2024-08-05",
            "items": [
                {
                    "id": "9c41c548-c576-4206-a2a2-fc5e7cfc2b72",
                    "title": "Compra teste",
                    "value": "0.99",
                    "type": "food"
                },
                {
                    "id": "9c3e5d40-39fb-44c5-b050-5cc89305d067",
                    "title": "Compra mensal",
                    "value": "400.00",
                    "type": "food"
                }
            ]
        }
    ]
    },
}
</code>
</pre>




        </div>
        </section>
</body>

</html>