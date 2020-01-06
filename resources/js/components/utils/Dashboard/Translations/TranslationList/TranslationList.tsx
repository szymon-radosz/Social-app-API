import React from "react";
import TranslationListRow from "./TranslationListRow/TranslationListRow";

const TranslationList = ({
    translations,
    handleTranslationSave,
    handleTranslationRemove
}) => {
    return (
        <>
            <div className="table-responsive">
                <table className="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">En</th>
                            <th scope="col">De</th>
                            <th scope="col">Fr</th>
                            <th scope="col">Es</th>
                            <th scope="col">Zh</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        {translations &&
                            translations.map((translation, i) => {
                                return (
                                    <TranslationListRow
                                        key={i}
                                        translation={translation}
                                        i={i}
                                        handleTranslationSave={
                                            handleTranslationSave
                                        }
                                        handleTranslationRemove={
                                            handleTranslationRemove
                                        }
                                    />
                                );
                            })}
                    </tbody>
                </table>
            </div>
        </>
    );
};

export default TranslationList;
