import React, { Component } from "react";
import {
    ProductCategoriesProps,
    ProductCategoriesState
} from "./ProductCategories.interface";
import DashboardContainer from "./../../DashboardContainer/DashboardContainer";
import { MainContext } from "./../../../MainContext";
import Header from "./../utils/Header";

class ProductCategories extends Component<
    ProductCategoriesProps,
    ProductCategoriesState
> {
    constructor(props: ProductCategoriesProps) {
        super(props);

        this.state = {};
    }

    componentDidMount = () => {
        this.context.handlAactiveMenuSection("Product Categories");
    };

    render() {
        return (
            <DashboardContainer>
                <Header text="Product Categories" />
            </DashboardContainer>
        );
    }
}

ProductCategories.contextType = MainContext;
export default ProductCategories;
