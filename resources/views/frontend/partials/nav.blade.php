<nav class="navbar navbar-expand-lg navbar-dark bg-light">
    <div class="container">
        <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button> -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Home</a>
                </li>
                @foreach ($categories as $category)
                    <!-- Electronics Category -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            {{ $category->name }}
                        </a>
                        <div class="dropdown-menu" style="display: flex; flex-wrap: wrap; gap: 20px;">
                            @foreach ($category->childrenCategories as $subcategory)
                                <div class="subcategory-column">
                                    <h6 class="subcategory-title">{{ $subcategory->name }}</h6>
                                    <ul class="sub-subcategory-list">
                                        @foreach ($subcategory->childrenCategories as $subsubcategory)
                                            <li><a href="#">{{ $subsubcategory->name }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endforeach
                        </div>
                    </li>
                @endforeach


                <!-- Other categories -->
                <li class="nav-item">
                    <a class="nav-link" href="#">New Arrivals</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Best Sellers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Deals</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
