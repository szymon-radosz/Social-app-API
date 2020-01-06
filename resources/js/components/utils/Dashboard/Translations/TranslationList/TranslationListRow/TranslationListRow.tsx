import React, { useState } from "react";

const TranslationListRow = ({
    translation,
    i,
    handleTranslationSave,
    handleTranslationRemove
}) => {
    const [name, setName] = useState(translation.name);
    const [en, setEn] = useState(translation.en);
    const [de, setDe] = useState(translation.de);
    const [fr, setFr] = useState(translation.fr);
    const [es, setEs] = useState(translation.es);
    const [zh, setZh] = useState(translation.zh);

    return (
        <tr>
            <th scope="row">{i + 1}</th>
            <td>
                {translation.blocked ? (
                    translation.name
                ) : (
                    <div className="form-group">
                        <input
                            type="text"
                            className="form-control"
                            placeholder="Translation name"
                            value={name}
                            onChange={e => setName(e.target.value)}
                        />
                    </div>
                )}
            </td>
            <td>
                <div className="form-group">
                    <input
                        type="text"
                        className="form-control"
                        placeholder="En"
                        value={en}
                        onChange={e => setEn(e.target.value)}
                    />
                </div>
            </td>
            <td>
                <div className="form-group">
                    <input
                        type="text"
                        className="form-control"
                        placeholder="De"
                        value={de}
                        onChange={e => setDe(e.target.value)}
                    />
                </div>
            </td>
            <td>
                <div className="form-group">
                    <input
                        type="text"
                        className="form-control"
                        placeholder="Fr"
                        value={fr}
                        onChange={e => setFr(e.target.value)}
                    />
                </div>
            </td>
            <td>
                <div className="form-group">
                    <input
                        type="text"
                        className="form-control"
                        placeholder="Es"
                        value={es}
                        onChange={e => setEs(e.target.value)}
                    />
                </div>
            </td>
            <td>
                <div className="form-group">
                    <input
                        type="text"
                        className="form-control"
                        placeholder="Zh"
                        value={zh}
                        onChange={e => setZh(e.target.value)}
                    />
                </div>
            </td>
            <td>
                <button
                    type="button"
                    onClick={() =>
                        handleTranslationSave(
                            translation.id,
                            name,
                            en,
                            de,
                            fr,
                            es,
                            zh
                        )
                    }
                    className="btn blue-btn"
                >
                    Save
                </button>
            </td>
            <td>
                {translation.blocked ? (
                    ""
                ) : (
                    <button
                        type="button"
                        onClick={() => handleTranslationRemove(translation.id)}
                        className="btn red-btn"
                    >
                        Remove
                    </button>
                )}
            </td>
        </tr>
    );
};

export default TranslationListRow;
