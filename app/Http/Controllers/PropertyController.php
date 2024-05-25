<?php

namespace App\Http\Controllers;

use App\Http\Requests\PropertyContactRequest;
use App\Http\Requests\SearchPropertiesRequest;
use App\Mail\PropertyContactMail;
use App\Models\Property;
use Illuminate\Support\Facades\Mail;

class PropertyController extends Controller
{
    public function index(SearchPropertiesRequest $request)
    {
        $query = Property::query()->orderBy('created_at', 'desc');
        $validated = $request->validated();
        
        if (isset($validated['price'])) {
            $query = $query->where('price', '<=', $validated['price']);
        }
        
        if (isset($validated['surface'])) {
            $query = $query->where('surface', '>=', $validated['surface']);
        }
        
        if (isset($validated['rooms'])) {
            $query = $query->where('rooms', '>=', $validated['rooms']);
        }

        if (isset($validated['title'])) {
            $query = $query->where('title', 'like', "%{$validated['title']}%");
        }

       /* if (isset($validated['image'])) {
            $query = $query->where('image', 'like', "%{$validated['image']}%");
        }*/
        
        return view('property.index', [
            'properties' => $query->paginate(16),
            'input' => $validated
        ]);
    }

    public function show(string $slug, Property $property)
    {
        $expectedSlug = $property->getSlug();
        if ($slug !== $expectedSlug) {
            return redirect()->route('property.show', ['slug' => $expectedSlug, 'property'=> $property]);
        }
        
        return view('property.show', [
            'property' => $property
        ]);
    }

    public function contact(Property $property, PropertyContactRequest $request) 
    {
        Mail::send(new PropertyContactMail($property, $request->validated()));
        return back()->with('success', 'Votre demande de contact a bien été envoyée');
    }
}