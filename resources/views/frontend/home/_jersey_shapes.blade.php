{{-- Dekoratif forma / spor şekilleri --}}
<svg class="absolute inset-0 w-full h-full" xmlns="http://www.w3.org/2000/svg"
     preserveAspectRatio="xMidYMid slice" viewBox="0 0 1440 700">

    {{-- Forma silueti 1 (sağ üst) --}}
    <g opacity="0.06" fill="white">
        <path d="M1200 -50 L1320 0 L1300 80 L1260 70 L1260 250 L1140 250 L1140 70 L1100 80 L1080 0 Z"/>
    </g>

    {{-- Forma silueti 2 (sol alt) --}}
    <g opacity="0.04" fill="white">
        <path d="M-80 500 L80 440 L110 540 L60 555 L60 780 L-140 780 L-140 555 L-190 540 Z"/>
    </g>

    {{-- Büyük daire (sağ) --}}
    <circle cx="1350" cy="350" r="300" fill="white" opacity="0.03"/>

    {{-- Küçük daireler --}}
    <circle cx="200" cy="100" r="120" fill="white" opacity="0.04"/>
    <circle cx="900" cy="600" r="180" fill="white" opacity="0.03"/>

    {{-- Diagonal çizgiler --}}
    <line x1="0" y1="700" x2="400" y2="0"
          stroke="white" stroke-width="60" opacity="0.03"/>
    <line x1="400" y1="700" x2="800" y2="0"
          stroke="white" stroke-width="40" opacity="0.02"/>

    {{-- Top silueti --}}
    <circle cx="700" cy="350" r="160" fill="none"
            stroke="white" stroke-width="30" opacity="0.04"/>
    <line x1="540" y1="350" x2="860" y2="350"
          stroke="white" stroke-width="8" opacity="0.05"/>
    <line x1="700" y1="190" x2="700" y2="510"
          stroke="white" stroke-width="8" opacity="0.05"/>
</svg>